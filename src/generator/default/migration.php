<?= '<?php' ?>

<?php if (isset($namespace)) {
    echo "\nnamespace $namespace;\n";
} ?>

/**
 * <?= $description ?>

 */
class <?= $className ?> extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('<?= $tableName ?>', [
<?php foreach ($attributes as $attribute): ?>
            '<?= $attribute['dbName'] ?>' => '<?= $attribute['dbType'] ?>',
<?php endforeach; ?>
		]);
<?php
		if(isset($attributes['uuid'])): ?>
				$this->addPrimaryKey('uuid_pk','<?=$tableName?>',['uuid']);
		<?php endif; ?>


        // TODO generate foreign keys
    }

    public function down()
    {
        $this->dropTable('<?= $tableName ?>');
    }
}
