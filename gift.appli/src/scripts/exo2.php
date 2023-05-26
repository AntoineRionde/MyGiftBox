<?php

require '../vendor/autoload.php';
ini_set('memory_limit', '512M');

use gift\app\models\Box;
use gift\app\models\Categorie;
use gift\app\models\Prestation;
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
$db->addConnection(parse_ini_file('../conf/config.ini'));
$db->setAsGlobal();
$db->bootEloquent();

/*echo "Question 1\n";
foreach (Prestation::all() as $presta) {
    echo "Prestation " . $presta->id  . "{ \n\t libellé : " . $presta->libelle . "\n\t description : " . $presta->description . "\n\t tarif : " . $presta->tarif . "€\n\t unite : " . $presta->unite . "\n}\n";
}*/

/*echo "Question 2\n";
foreach (Prestation::with('categorie')->get() as $presta) {
    echo "Prestation " . $presta->id .
        " { \n\t libellé : " . $presta->libelle . " ({$presta->categorie->libelle})".
        "\n\t description : " . $presta->description .
        "\n\t tarif : " . $presta->tarif .
        "€\n\t unite : " . $presta->unite .
        "\n}\n";
}*/

/*echo "Question 3\n";
$cat3 = Categorie::find(3);
echo $cat3->libelle . "\n";
foreach ($cat3->prestations()->get() as $presta){
    echo "Prestation " . $presta->id .
        " { \n\t libellé : " . $presta->libelle .
        "\n\t tarif : " . $presta->tarif .
        "€\n\t unite : " . $presta->unite .
        "\n}\n";
}*/

/*echo "Question 4\n";
$box = Box::find('360bb4cc-e092-3f00-9eae-774053730cb2');
echo "Box ({$box->id})}) {\n" .
    "\t libelle : " . $box->libelle .
    "\n\t description : " . $box->description .
    "\n\t tarif : " . $box->tarif . "€\n";*/

/*echo "Question 5\n";
$box = Box::with('prestations')->find('360bb4cc-e092-3f00-9eae-774053730cb2');
echo "Box ({$box->id})}) {\n" .
    "\t libelle : " . $box->libelle .
    "\n\t description : " . $box->description .
    "\n\t tarif : " . $box->tarif . "€\n";
foreach ($box->prestations()->get() as $presta) {
    echo "\t Prestation " . $presta->id .
        " { \n\t\t libellé : " . $presta->libelle .
        "\n\t\t tarif : " . $presta->tarif .
        "€\n\t\t unite : " . $presta->unite .
        "\n\t quantite : " . $presta->contenu->quantite .
        "\n\t}\n";
}*/

echo "Question 6\n";
//create 3 box (id, token, libelle, description(lorem ipsum), montant, kdo(boolean), message_kdo(if kdo == 1), status and attach them
$box = new Box();
$box->id = '360bb4cc-e092-3f00-9eae-774053730cb2';
$box->token = base64_encode(random_bytes(32));
$box->libelle = 'Box 20';
$box->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla euismod, nisl eget aliquam ultricies, nunc nisl ultricies nunc, quis aliquam n';
$box->updated_at = date('Y-m-d H:i:s');
$box->save();
$box->prestations()->attach([
    '4cca8b8e-0244-499b-8247-d217a4bc542d', ['quantite' => 1],
    '14872d96-97d6-4a9f-8a28-463886fea622', ['quantite' => 10],
    '63cdce06-cd63-4fbe-9695-885d3cb64c7b', ['quantite' => 3],
]);