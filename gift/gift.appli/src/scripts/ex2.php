<?php
use Illuminate\Database\Capsule\Manager as DB;
use gift\app\models\Prestation;
use gift\app\models\Categorie;
use Ramsey\Uuid\Uuid;
use gift\app\models\Box;
require '../vendor/autoload.php';

$db = new DB();
$db->addConnection(parse_ini_file('../conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();
$prestations = Prestation::all();
// Q1
//foreach ($prestations as $presta) {
//    print $presta->libelle. ' '. $presta->description. ' '.$presta->tarif.' '.$presta->unite."\n";
//}

// Q2
//foreach ($prestations as $presta) {
//    foreach(Prestation::with('categorie')->get() as $presta)
//    {
//        echo $presta->libelle. "({$presta->categorie->libelle}";
//    }
//    print ' '. $presta->description. ' '.$presta->tarif.' '."\n";
//}

// Q3
//$cat3 = Categorie::find(3);
//print $cat3->libelle;
//foreach ($cat3->prestations()->get() as $presta)
//{
//    echo $presta->libelle. PHP_EOL;
//    echo $presta->tarif. PHP_EOL;
//    echo $presta->unite. PHP_EOL;
//}

// Q4
//$box = Box::find('360bb4cc-e092-3f00-9eae-774053730cb2');
//print $box->libelle. PHP_EOL;
//print $box->description. PHP_EOL;
//print $box->montant. PHP_EOL;

// Q5
//$box = Box::find('360bb4cc-e092-3f00-9eae-774053730cb2');
//print $box->libelle. PHP_EOL;
//print $box->description. PHP_EOL;
//print $box->montant. PHP_EOL;
//foreach ($box->prestations()->get() as $prestation)
//{
//    print $prestation->libelle.' '.$prestation->tarif.' '.$prestation->unite.' '.$prestation->contenu->quantite."\n";
//}

// Q6
$box = new Box();
$box->id = Uuid::uuid4()->toString();
$box ->libelle = 'Box 6';
$box->description = 'Description box 6';
$box->token = base64_encode(random_bytes(32));

$box->save();
// associer 3 prestations à la box
$box->prestations()->attach([
    '4cca8b8e-0244-499b-8247-d217a4bc542d' => ['quantite' => 1],
    'a277c67f-eb06-40a3-bc06-0d067159e886' => ['quantite' => 2],
    '95a72f23-2ee7-4cbe-98d0-3d372102fcae' => ['quantite' => 3],
]);

