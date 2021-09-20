<?php

use App\Models\ClientAccountType;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateClientsView extends Migration
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
        $acc_type_id = ClientAccountType::T_MANAGING_ACCOUNT;

        return <<<EOF
CREATE ALGORITHM=MERGE VIEW view_clients AS
SELECT
    c.id,
    IF(ISNULL(c.deleted_at), 0, 1) AS deleted,

    CASE WHEN u.id IS NULL THEN '[]'
    ELSE CAST(CONCAT('[',
    GROUP_CONCAT(JSON_OBJECT(
        'id', u.id,
        'full_name', u.full_name,
        'email', u.email)),
    ']') AS JSON)  END managing_accounts,
    c.public_id,
    c.status_id,
    c.title,
    c.description,
    c.address,
    c.theme,
    s.title AS status_title,
    s.config AS status_config,
    c.created_at,
    c.updated_at,
    c.expires_at,
    c.last_seen_at,
    c.last_login_at

FROM clients c

LEFT JOIN client_statuses s
    ON s.id = c.status_id

LEFT JOIN users u
    ON u.client_id = c.id AND u.type_id = {$acc_type_id}

GROUP BY c.id
EOF;
    }

    protected function dropView()
    {
        return 'DROP VIEW IF EXISTS view_clients';
    }
}
