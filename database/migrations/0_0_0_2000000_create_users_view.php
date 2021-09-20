<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateUsersView extends Migration
{
    public function up()
    {
        DB::unprepared($this->dropView());
        DB::unprepared($this->createView());
    }

    public function down()
    {
        DB::unprepared($this->dropView());
    }

    protected function createView()
    {
        return <<<EOF
CREATE ALGORITHM=MERGE VIEW view_users AS
SELECT

    u.id,
    IF(ISNULL(u.deleted_at), 0, 1) AS deleted,

    p.id as permission_id,
    CASE WHEN p.id IS NULL THEN '[]'
    ELSE CAST(CONCAT('[',
    GROUP_CONCAT(JSON_OBJECT(
        'id', p.id,
        'permission', p.permission
        )),
    ']') AS JSON)  END permissions,

    u.type_id,
    u.client_id,
    u.status_id,
    u.full_name,
    u.email,
    u.config,
    u.email_verified_at,
    u.created_at,
    u.expires_at,
    u.updated_at,
    u.deleted_at,
    u.last_seen_at,
    s.title AS status_title,
    s.description AS status_description,
    s.config AS status_config,
    c.title AS client_title,
    t.title AS type_title,
    t.description AS type_description,
    t.config AS type_config

FROM users u

LEFT JOIN user_statuses s
ON s.id = u.status_id

INNER JOIN clients c
    ON c.id  = u.client_id

INNER JOIN client_account_types t
    ON t.id = u.type_id

LEFT JOIN  users2permissions u2p
    ON u2p.user_id = u.id

LEFT JOIN permissions p
    ON p.id = u2p.permission_id

GROUP BY u.id

EOF;
    }

    protected function dropView()
    {
        return 'DROP VIEW IF EXISTS view_users';
    }
}
