<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesView extends Migration
{
    public function up()
    {
        DB::unprepared($this->dropView());
        DB::unprepared($this->createView());
    }

    public function down()
    {
        Schema::dropIfExists('view_properties');
    }


    protected function createView()
    {
        return <<<EOF
CREATE ALGORITHM=MERGE VIEW view_properties AS
SELECT

    p.id,
    IF(ISNULL(p.deleted_at), 0, 1) AS deleted,
    p.client_id,
    p.title,
    c.title AS client_title,
    c.description AS client_description,
    (SELECT COUNT(*) FROM equipment WHERE property_id = p.id) AS equipment_count,
    p.description,
    p.address_formatted,
    p.address_line_1,
    p.address_line_2,
    p.city,
    p.postcode,
    p.created_at,
    p.updated_at,
    p.deleted_at

FROM properties p

INNER JOIN clients c
ON c.id = p.client_id


EOF;
    }

    protected function dropView()
    {
        return 'DROP VIEW IF EXISTS view_properties';
    }
}
