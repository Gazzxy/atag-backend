<?php


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentReportsView extends Migration
{
    public function up()
    {
        DB::unprepared($this->dropView());
        DB::unprepared($this->createView());
    }

    public function down()
    {
        Schema::dropIfExists('view_equipment_reports');
    }


    protected function createView()
    {
        return <<<EOF
CREATE ALGORITHM=MERGE VIEW view_equipment_reports AS
SELECT
	r.id,
	r.equipment_id,
	e.public_id,
	p.client_id,
	e.title as equipment_title,
	IF(ISNULL(r.deleted_at), 0, 1) AS deleted,
	r.user_id,
	u.full_name,
	u.email,
	r.title,
	r.url,
	r.filename,
	r.filepath,
	r.created_at,
	r.updated_at

FROM equipment_reports r

INNER JOIN equipment e
ON e.id = r.equipment_id

inner join properties p
on p.id = e.property_id

INNER JOIN users u
ON u.id = r.user_id


EOF;
    }

    protected function dropView()
    {
        return 'DROP VIEW IF EXISTS view_equipment_reports';
    }
}
