<?= '<?php' ?>

<?php if (isset($namespace)) {
echo "\nnamespace $namespace;\n";
}
?>
<?php
$foreignSource = strtolower($reference['source']);
$foreignTarget = strtolower($reference['target']);

$foreignTable1Name = strtolower($foreignSource).'_'.strtolower($foreignTarget);

$foreignTable1 = [
	'name' => 'fk-'.$foreignTable1Name,
	'table' => strtolower($tableName),
	'tableColumn' => strtolower($foreignSource.'_uuid'),
	'tableforeign' => $foreignSource,
	'foreignColumn' => 'uuid',
];

$foreignTable2Name = strtolower($foreignTarget).'_' .strtolower($foreignSource);
$foreignTable2 = [
	'name' => 'fk-'. $foreignTable2Name,
	'table' => strtolower($tableName),
	'tableColumn' => strtolower($foreignTarget.'_uuid'),
	'tableforeign' => $foreignTarget,
	'foreignColumn' => 'uuid',
];

$indexTable1 = [
	'name' => 'id-' . $foreignTable1Name ,
	'table' => strtolower($tableName),
	'column' => $foreignTable1['tableColumn']
];
$indexTable2 = [
	'name' => 'id-' . $foreignTable2Name ,
	'table' => strtolower($tableName),
	'column' => $foreignTable2['tableColumn']
];

?>
class <?= $className ?> extends \yii\db\Migration
{
    public function up()
    {
		$this->createTable('<?= strtolower($tableName) ?>',
			[
				'<?= $foreignTable1['tableColumn']?>' => $this->string(36), 	
				'<?= $foreignTable2['tableColumn']?>' => $this->string(36), 	
				'PRIMARY KEY(<?=$foreignTable1['tableColumn']?>,<?=$foreignTable2['tableColumn']?> )',
			]
		);

		
		$this->addForeignKey('<?= join(',',$foreignTable1)?>');
		$this->addForeignKey('<?= join(',',$foreignTable2)?>');

		$this->addIndex('<?= join(',',$indexTable1)?>');
		$this->addIndex('<?= join(',',$indexTable2)?>');
    }

    public function down()
    {
        $this->dropTable('<?= $tableName ?>');
    }
}
