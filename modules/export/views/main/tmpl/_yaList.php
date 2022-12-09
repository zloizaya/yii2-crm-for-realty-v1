<?php 
use Yii;
use app\modules\base\models\Base;
use yii\helpers\Html;

$createtime = new DateTime($model->created_at);
$updatetime = new DateTime($model->updated_at);
?> 
  <?php if($model->step === Base::STEP_SECOND){ ?>
  <!-- Квартира на вторичном рынке -->     
  <offer internal-id="<?= $model->id ?>">         
    <type><?= $model->getAdsArray()[$model->typeAds] ?></type>         
    <property-type><?= $model->getPropertyArray()[$model->typeProperty] ?></property-type>         
    <category><?= $model->getTypeArray()[$model->typeObj] ?></category>   
    <deal-status><?= $model->getStepArray()[$model->step] ?></deal-status>               
    <creation-date><?= $createtime->format(DateTime::ATOM); ?></creation-date>
    <last-update-date><?= $updatetime->format(DateTime::ATOM) ?></last-update-date>
    <location>             
      <country>Россия</country>  
      <region><?= $model->land ?></region>           
      <locality-name><?= $model->city ?></locality-name>             
      <address><?= $model->street ?>, <?= $model->house ?></address>        
    </location>         
    <sales-agent>
      <name><?= $model->seller->full_name ?></name>
      <category>agency</category>
      <organization><?= Yii::$app->params['corpName'] ?></organization>
      <url><?= Yii::$app->params['corpSite'] ?></url>
      <phone><?= Yii::$app->formatter->asPhone($model->seller->phone, 'RU', false) ?></phone>
      <email><?= $model->seller->email ?></email>
    </sales-agent>     
    <price>     
      <value><?= $model->price_sale ?></value>        
      <currency>RUR</currency> 
    </price>
    <image><?= $model->image ?></image>
    <area>     
      <value><?= $model->totalSquare ?></value>     
      <unit>кв. м</unit> 
    </area> 
    <description><?= Html::encode($model->description) ?></description>
    <rooms>1</rooms>
    <rooms-offered>1</rooms-offered>
    <floor><?= $model->floor ?></floor>
  </offer>
  <?php } ?>
