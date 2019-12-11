
namespace <?= $namespace ?>;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\<?= $modelClass ?>;

/**
 * HlzpubPublicationSearch represents the model behind the search form of `common\models\HlzpubPublication`.
 */
class <?= $modelClass ?>Search extends <?= $modelClass ?>
{
    /**
     * {@inheritdoc}
     */
    public $category='';
    public $series='';
    public function rules()
	{
		return [
	<?php
    $safeAttributes = [];
    $requiredAttributes = [];
    $integerAttributes = [];
    $stringAttributes = [];
		foreach($attributes as $key=>$attribute){
			$name = $attribute['name'];
			if ($attribute['readOnly']) {
				continue;
			}
			if ($attribute['required']) {
				$requiredAttributes[$name] = $name;
			}
			switch($attribute['type']){
				case 'integer' :
					$integerAttributes[$name] = $name;
					break;
				case 'string' :
					$stringAttributes[$name] = $name;
					break;
				default:break;

			}
		}
    if (!empty($stringAttributes)) {
        echo "            [['" . implode("', '", $stringAttributes) . "'], 'trim'],\n";
    }
    if (!empty($requiredAttributes)) {
        echo "            [['" . implode("', '", $requiredAttributes) . "'], 'required'],\n";
    }
    if (!empty($stringAttributes)) {
        echo "            [['" . implode("', '", $stringAttributes) . "'], 'string'],\n";
    }
    if (!empty($integerAttributes)) {
        echo "            [['" . implode("', '", $integerAttributes) . "'], 'integer'],\n";
    }
    if (!empty($safeAttributes)) {
        echo "            // TODO define more concreate validation rules!\n";
        echo "            [['" . implode("','", $safeAttributes) . "'], 'safe'],\n";
    }

?>
];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
	   $query = $this-><?=$modelClass?>::find();
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // grid filtering conditions
		$query->andFilterWhere([
<?php
	foreach ($integerAttributes as $attribute) :
			$name = $attribute;
			?> 
			'<?=$name?>' => $this-><?= $name?>,
	<?php
	endforeach;
	?>
        ]);
		<?php
			if(count($stringAttributes) > 0) : 
		?>
		$query->andFilterWhere(['like','<?=$name?>',$this-><?=$name?> ]);
		<?php
			endif;
		?>	
        return $dataProvider;
    }
}