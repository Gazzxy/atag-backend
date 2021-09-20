<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentView extends Migration
{
    public function up()
    {
        DB::unprepared($this->dropView());
        DB::unprepared($this->createView());
    }

    public function down()
    {
        Schema::dropIfExists('view_equipment');
    }


    protected function createView()
    {
        return <<<EOF
CREATE ALGORITHM=MERGE VIEW view_equipment AS
SELECT

    e.id,
    e.public_id,
    IF(ISNULL(e.deleted_at), 0, 1) AS deleted,
    e.property_id,
    p.client_id,
    e.title,
    e.description,
    p.title as property_title,
    p.description as property_description,
    p.address_formatted AS property_address,
    c.title as client_title,
    c.address as client_address,
    e.metadata,
    e.installed_at,
    e.last_service_at,
    e.expires_at,
    e.created_at,
    e.updated_at,
    e.deleted_at,
    p.created_at as property_created_at

FROM equipment e

INNER JOIN properties p
ON p.id = e.property_id

INNER JOIN clients c
ON c.id = p.client_id

EOF;
    }

    protected function dropView()
    {
        return 'DROP VIEW IF EXISTS view_equipment';
    }
}
