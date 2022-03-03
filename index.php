<?php

define("time_buffer",6*3600);
define("main","irmar");
define("calendar_dir","calendar");
define("main_ics",calendar_dir."/".main.".ics");

// all seminar types
$types_colornamenum = [
  "colloquium"                                => ["#006266", "Colloquium"                                   , 228 ],
  "cours-doctoral"                            => ["#1B1464", "Cours doctoral"                               , 275 ],
  "cryptographie"                             => ["#9980FA", "Séminaire de cryptographie"                   , 229 ],
  "dejeuner-des-mathematiciennes"             => ["#25CCF7", "Déjeumer des Mathématiciennes"                , 263 ],
  "equations-aux-derivees-partielles"         => ["#1289A7", "Séminaire équations aux dérivées partielles"  , 225 ],
  "ethique-et-mathematique"                   => ["#FEA47F", "Éthique et Mathématiques"                     , 288 ],
  "geometrie"                                 => ["#A3CB38", "Séminaire de géométrie"                       , 231 ],
  "geometrie-analytique"                      => ["#009432", "Séminaire de géométrie analytique"            , 232 ],
  "geometrie-arithmetique"                    => ["#D980FA", "Séminaire de géométrie arithmétique"          , 233 ],
  "geometrie-et-algebre-effectives"           => ["#EE5A24", "Séminaire de géométrie et algèbre effectives" , 234 ],
  "geometrie-et-singularites"                 => ["#833471", "Séminaire de géométrie et singularités"       , 235 ],
  //"groupe-de-travail-processus-stochastiques" => ["#12CBC4", "Groupe de travail Processus stochastiques"    , 000 ],
  "seminaire-analyse-numerique"               => ["#C4E538", "Séminaire analyse numérique"                  , 227 ],
  "seminaire-apero"                           => ["#5758BB", "Séminaire Apéro"                              , 264 ],
  "seminaire-d-analyse"                       => ["#6F1E51", "Séminaire d'Analyse"                          , 282 ],
  "seminaire-de-probabilites"                 => ["#FDA7DF", "Séminaire de Probabilités"                    , 238 ],
  "seminaire-gaussbusters"                    => ["#ED4C67", "Séminaire Gaussbusters"                       , 230 ],
  "seminaire-landau"                          => ["#FFC312", "Séminaire Landau"                             , 236 ],
  "seminaire-pampers"                         => ["#B53471", "Séminaire Pampers"                            , 237 ],
  "soutenance"                                => ["#EA2027", "Soutenances"                                  , 247 ],
  "statistique"                               => ["#0652DD", "Séminaire de statistique"                     , 240 ],
  "theorie-ergodique"                         => ["#F79F1F", "Séminaire de théorie ergodique"               , 241 ],
  main                                        => ["#ffffff", "Tous les séminaires de l'IRMAR"               , 000 ]
];

$list_seminar = array();
foreach ($types_colornamenum as $type => $v) {
  $list_seminar[$type] = [];
}

function remove_accents($string) {
    if ( !preg_match('/[\x80-\xff]/', $string) )
        return $string;

    $chars = array(
    // Decompositions for Latin-1 Supplement
    chr(195).chr(128) => 'A', chr(195).chr(129) => 'A', chr(195).chr(130) => 'A', chr(195).chr(131) => 'A', chr(195).chr(132) => 'A', chr(195).chr(133) => 'A', chr(195).chr(135) => 'C', chr(195).chr(136) => 'E', chr(195).chr(137) => 'E', chr(195).chr(138) => 'E', chr(195).chr(139) => 'E', chr(195).chr(140) => 'I', chr(195).chr(141) => 'I', chr(195).chr(142) => 'I', chr(195).chr(143) => 'I', chr(195).chr(145) => 'N', chr(195).chr(146) => 'O', chr(195).chr(147) => 'O', chr(195).chr(148) => 'O', chr(195).chr(149) => 'O', chr(195).chr(150) => 'O', chr(195).chr(153) => 'U', chr(195).chr(154) => 'U', chr(195).chr(155) => 'U', chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y', chr(195).chr(159) => 's', chr(195).chr(160) => 'a', chr(195).chr(161) => 'a', chr(195).chr(162) => 'a', chr(195).chr(163) => 'a', chr(195).chr(164) => 'a', chr(195).chr(165) => 'a', chr(195).chr(167) => 'c', chr(195).chr(168) => 'e', chr(195).chr(169) => 'e', chr(195).chr(170) => 'e', chr(195).chr(171) => 'e', chr(195).chr(172) => 'i', chr(195).chr(173) => 'i', chr(195).chr(174) => 'i', chr(195).chr(175) => 'i', chr(195).chr(177) => 'n', chr(195).chr(178) => 'o', chr(195).chr(179) => 'o', chr(195).chr(180) => 'o', chr(195).chr(181) => 'o', chr(195).chr(182) => 'o', chr(195).chr(182) => 'o', chr(195).chr(185) => 'u', chr(195).chr(186) => 'u', chr(195).chr(187) => 'u', chr(195).chr(188) => 'u', chr(195).chr(189) => 'y', chr(195).chr(191) => 'y',
    // Decompositions for Latin Extended-A
    chr(196).chr(128) => 'A', chr(196).chr(129) => 'a', chr(196).chr(130) => 'A', chr(196).chr(131) => 'a', chr(196).chr(132) => 'A', chr(196).chr(133) => 'a', chr(196).chr(134) => 'C', chr(196).chr(135) => 'c', chr(196).chr(136) => 'C', chr(196).chr(137) => 'c', chr(196).chr(138) => 'C', chr(196).chr(139) => 'c', chr(196).chr(140) => 'C', chr(196).chr(141) => 'c', chr(196).chr(142) => 'D', chr(196).chr(143) => 'd', chr(196).chr(144) => 'D', chr(196).chr(145) => 'd', chr(196).chr(146) => 'E', chr(196).chr(147) => 'e', chr(196).chr(148) => 'E', chr(196).chr(149) => 'e', chr(196).chr(150) => 'E', chr(196).chr(151) => 'e', chr(196).chr(152) => 'E', chr(196).chr(153) => 'e', chr(196).chr(154) => 'E', chr(196).chr(155) => 'e', chr(196).chr(156) => 'G', chr(196).chr(157) => 'g', chr(196).chr(158) => 'G', chr(196).chr(159) => 'g', chr(196).chr(160) => 'G', chr(196).chr(161) => 'g', chr(196).chr(162) => 'G', chr(196).chr(163) => 'g', chr(196).chr(164) => 'H', chr(196).chr(165) => 'h', chr(196).chr(166) => 'H', chr(196).chr(167) => 'h', chr(196).chr(168) => 'I', chr(196).chr(169) => 'i', chr(196).chr(170) => 'I', chr(196).chr(171) => 'i', chr(196).chr(172) => 'I', chr(196).chr(173) => 'i', chr(196).chr(174) => 'I', chr(196).chr(175) => 'i', chr(196).chr(176) => 'I', chr(196).chr(177) => 'i', chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij', chr(196).chr(180) => 'J', chr(196).chr(181) => 'j', chr(196).chr(182) => 'K', chr(196).chr(183) => 'k', chr(196).chr(184) => 'k', chr(196).chr(185) => 'L', chr(196).chr(186) => 'l', chr(196).chr(187) => 'L', chr(196).chr(188) => 'l', chr(196).chr(189) => 'L', chr(196).chr(190) => 'l', chr(196).chr(191) => 'L', chr(197).chr(128) => 'l', chr(197).chr(129) => 'L', chr(197).chr(130) => 'l', chr(197).chr(131) => 'N', chr(197).chr(132) => 'n', chr(197).chr(133) => 'N', chr(197).chr(134) => 'n', chr(197).chr(135) => 'N', chr(197).chr(136) => 'n', chr(197).chr(137) => 'N', chr(197).chr(138) => 'n', chr(197).chr(139) => 'N', chr(197).chr(140) => 'O', chr(197).chr(141) => 'o', chr(197).chr(142) => 'O', chr(197).chr(143) => 'o', chr(197).chr(144) => 'O', chr(197).chr(145) => 'o', chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe', chr(197).chr(148) => 'R',chr(197).chr(149) => 'r', chr(197).chr(150) => 'R',chr(197).chr(151) => 'r', chr(197).chr(152) => 'R',chr(197).chr(153) => 'r', chr(197).chr(154) => 'S',chr(197).chr(155) => 's', chr(197).chr(156) => 'S',chr(197).chr(157) => 's', chr(197).chr(158) => 'S',chr(197).chr(159) => 's', chr(197).chr(160) => 'S', chr(197).chr(161) => 's', chr(197).chr(162) => 'T', chr(197).chr(163) => 't', chr(197).chr(164) => 'T', chr(197).chr(165) => 't', chr(197).chr(166) => 'T', chr(197).chr(167) => 't', chr(197).chr(168) => 'U', chr(197).chr(169) => 'u', chr(197).chr(170) => 'U', chr(197).chr(171) => 'u', chr(197).chr(172) => 'U', chr(197).chr(173) => 'u', chr(197).chr(174) => 'U', chr(197).chr(175) => 'u', chr(197).chr(176) => 'U', chr(197).chr(177) => 'u', chr(197).chr(178) => 'U', chr(197).chr(179) => 'u', chr(197).chr(180) => 'W', chr(197).chr(181) => 'w', chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y', chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z', chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z', chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z', chr(197).chr(190) => 'z', chr(197).chr(191) => 's'
    );

    $string = strtr($string, $chars);

    return $string;
}

class ICS {
  // FROM : https://gist.github.com/jakebellacera/635416
  
  //const DT_FORMAT_lt  = 'Ymd\THis'; // legal time format
  //const DT_FORMAT_utc = 'Ymd\THis\Z'; // UTC format

  public $dt_format = 'Ymd\THis';
  protected $properties = array();
  private $available_properties = array(
    'description',
    'dtend',
    'dtstart',
    'location',
    'summary',
    'url'
  );

  public function __construct($props,$format) {
    $this->dt_format = $format;
    $this->set($props);
  }

  public function set($key, $val = false) {
    if (is_array($key)) {
      foreach ($key as $k => $v) {
        $this->set($k, $v);
      }
    } else {
      if (in_array($key, $this->available_properties)) {
        $this->properties[$key] = $this->sanitize_val($val, $key);
      }
    }
  }

  public function to_string() {
    $rows = $this->build_props();
    return implode("\r\n", $rows);
  }

  private function build_props() {
    // Build ICS properties - add header
    $ics_props = array(
      'BEGIN:VEVENT'
    );

    // Build ICS properties - add header
    $props = array();
    foreach($this->properties as $k => $v) {
      $props[strtoupper($k . ($k === 'url' ? ';VALUE=URI' : ''))] = $v;
    }

    // Set some default values
    $props['DTSTAMP'] = $this->format_timestamp('now');
    $props['UID'] = uniqid();

    // Append properties
    foreach ($props as $k => $v) {
      $ics_props[] = "$k:$v";
    }

    // Build ICS properties - add footer
    $ics_props[] = 'END:VEVENT';

    return $ics_props;
  }

  private function sanitize_val($val, $key = false) {
    switch($key) {
      case 'dtend':
      case 'dtstamp':
      case 'dtstart':
        $val = $this->format_timestamp($val);
        break;
      default:
        $val = $this->escape_string($val);
    }

    return $val;
  }

  private function format_timestamp($timestamp) {
    $dt = new DateTime($timestamp);
    //return $dt->format(self::DT_FORMAT);
    return $dt->format($this->dt_format);
  }

  private function escape_string($str) {
    return preg_replace('/([\,;])/','\\\$1', $str);
  }
}

function array_to_calendar($seminars,$seminar_name) {
  date_default_timezone_set("Europe/Paris");
  $calendar = array(
    "BEGIN:VCALENDAR",
    "VERSION:2.0",
    "PRODID:-//hacksw/handcal//NONSGML v1.0//EN",
    "CALSCALE:GREGORIAN",
    "X-WR-CALNAME:".$seminar_name,
    "TIMEZONE-ID:Europe/Paris",
    "X-WR-TIMEZONE:Europe/Paris"
  );
  foreach ( $seminars as $seminar ) {
    $ics = new ICS($seminar,'Ymd\THis');
    $calendar[] = $ics->to_string();
  }
  $calendar[] = "END:VCALENDAR";
  return implode("\r\n", $calendar);
}

// convert raw data to ICS-ish array
function data_event($event) {
  GLOBAL $url;
  $event_doc = new DOMDocument();
  $event_doc->loadHTML("<html><head><meta charset='utf-8'/></head><body>{$event["title"]}</body></html>");
  $xpath = new DOMXpath($event_doc);

  $orator = $xpath->query("*//div/@*[contains(.,'field--name-field-orator-name')]/parent::*")->item(0)->nodeValue;
  $affiliation = $xpath->query("*//div/@*[contains(.,'field--name-field-orator-affiliate')]/parent::*")->item(0)->nodeValue;
  if (strlen($affiliation) > 0) {
    $description = "$orator ($affiliation)";
  } else {
    $description = $orator;
  }

  $type = $xpath->query("*//div[@class='type']")->item(0)->nodeValue;
  return [
    'type'        => strtr(strtolower(remove_accents($type)),[' '=>'-',"'"=>'-']),
    'dtstart'     => $event['start'],
    'dtend'       => $event['end'],
    'url'         => $url.$event['url'],
    'summary'     => $xpath->query("*//div[@class='title']")->item(0)->nodeValue,
    'location'    => $xpath->query("*//div[@class='places']")->item(0)->nodeValue,
    'description' => $description,
  ];
}

function cmp_event($a,$b) { return $a['dtstart'] < $b['dtstart']; }

// if there is no file or there are to old, generate all of them
$filename = main_ics;
if ( ! file_exists($filename) or time() - filemtime($filename) > time_buffer ) {
  // extract data
  $url = "https://irmar.univ-rennes1.fr";

  $dom_doc = new DOMDocument();
  @$dom_doc->loadHTMLFile($url,LIBXML_NOWARNING);

  $dom_xpath = new DOMXpath($dom_doc);
  $raw = $dom_xpath->query("//script[@data-drupal-selector='drupal-settings-json']")->item(0)->nodeValue;

  // all event since 2017
  $data = array_values(json_decode($raw,true)["fullcalendar"])[0]["fullcalendar"]["_events"];

  $now = date("c");
  $events = []; // all events array
  foreach ($data as $event) {
    $d = data_event($event);
    if ( $now < $d['dtend'] ) {
      array_push($events , $d);
      array_push($list_seminar[$d['type']],$d);
    }
  }
  // sort events (why not...)
  //usort($events, "cmp_event");

  file_put_contents(main_ics,array_to_calendar($events,$types_colornamenum[main][1]));
  foreach ($list_seminar as $type => $seminars) {
    file_put_contents(calendar_dir."/".$type.".ics", array_to_calendar($seminars,$types_colornamenum[$type][1]) );
  }
}
////////////////////////////////////////////////////////////////////////////////

// all ics files are generated, now return the correct one

////////////////////////////////////////////////////////////////////////////////
// default seminar is the best one
// and test (with all needed protection) the input value

$seminar = "";
if ( isset($_GET["q"]) ) {
  $seminar = htmlspecialchars( $_GET["q"] );
}
// test if seminar is in the official list
// and display the correct list
// else display by birth date (to prevet any abuse)

if ( array_key_exists($seminar, $types_colornamenum) ) {

  //header('Content-Type: text/calendar; charset=utf-8');
  //header('Content-Disposition: attachment; filename='.$seminar.'.ics');
  if ( file_exists(calendar_dir."/".$seminar.".ics") ) {
    echo file_get_contents(calendar_dir."/".$seminar.".ics");
  } else {
    echo "ERROR...";
  }

} elseif ( isset($_GET["q"]) ) {

  header('Content-Type: text/calendar; charset=utf-8');
  header('Content-Disposition: attachment; filename=letraindetesinjuresroulesurleraildemonindiference.ics');

  $ics = new ICS(array(
    'location' => "Saint-Lizier (Ariège)",
    'summary' => "Naissance de Josselin Massot",
    'dtstart' => date("Y-m-d H:i","1990-04-18 23:50"),
    'description' => "Yes it's also St-Parfait"
  ));
  $calendar = array(
    "BEGIN:VCALENDAR",
    "VERSION:2.0",
    "PRODID:-//hacksw/handcal//NONSGML v1.0//EN",
    "CALSCALE:GREGORIAN",
  );
  $calendar[] = $ics->to_string();
  $calendar[] = "END:VCALENDAR";

  echo implode("\r\n", $calendar);

} else {
  header('Content-Type: text/html; charset=utf-8');
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Séminaire de l'IRMAR</title>
  <link rel="shortcut icon" href="https://irmar.univ-rennes1.fr/themes/custom/ur1_external_mdb/favicon.ico" type="image/vnd.microsoft.icon" />

  <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet" />
  <style type="text/css">
html, body {
  margin: 0; padding: 0;
  min-height: 100%; width: 100%;
  font-family: Open Sans, Helvetica Neue, Helvetica, Arial, sans-serif;
  font-size: 14px;
  color: rgb(67, 66, 65);
  font-weight: 300;
  -moz-osx-font-smoothing: grayscale;
  text-align: justify;
}
ol {
  display: flex;
  flex-wrap: wrap;
  margin: 0; padding: 0;
}
ol > li {
  max-width: calc(50% - 10px);
  display: flex;
  border: 1px solid #424242; border-radius: 3px;
  padding: 10px; margin: 5px;
  flex-wrap: nowrap;
  box-sizing: border-box;
  flex-direction: column;
}
/*
?php foreach ($types_colornamenum as $type => $value) { ?
    li[data-type="<?= $type ?>"] {
      background-color: <?= $value[0] ?>88;
    }
?php } ?
*/
h1,h2 {
  font-weight: 400;
}
h1 { font-size: 1.80203; }
h1 a, h1 a:visited { text-decoration: none; color: rgba(67, 66, 65,0.8); }
h1 a:hover { color: rgba(67, 66, 65,1); }
h2 { font-size: 1.60181rem; }
a {
  color: #de8d0e;;
  text-decoration: underline rgb(178, 113, 11);
  text-decoration-color: rgb(178, 113, 11);
  transition-duration: 0.2s;
}
a:hover, a:visited {
  color: #b2710b;
}
.container {
  margin: 0 auto;
  border-left: 1px solid #eaeff2;
  border-right: 1px solid #eaeff2;
  height: 100%;
  width: 80%; max-width: 1000px;
  padding: 3rem;
  box-sizing: border-box;
  box-shadow: 0 10px 20px rgba(0,0,0,.19),0 6px 6px rgba(0,0,0,.23);
  border-top: 4px solid #de8d0e;
}
.ics {
  font-weight: 200;
}
dt {
  font-size: 1.28571rem;
}
dd {
  font-size: 1.28571rem;
  margin-bottom: 1.00333rem;
  display: flex;
  align-items: center;
}
.btn {
  position: relative;
  display: flex;
  align-items: center;
  padding: 3px 6px;
  font-size: 13px;
  font-weight: 300;
  line-height: 12px;
  color: #333;
  white-space: nowrap;
  vertical-align: middle;
  cursor: pointer;
  background-color: #fefefe;
  border: 1px solid #d5d5d5;
  border-radius: 3px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  -webkit-appearance: none;
  margin: 0.28571rem;
}
.btn span {
  overflow: hidden;
  display: inline-block;
  transition-duration: 0.5s;
  width: 0;
  height: 13px;
}
.btn:hover span {
  width: 7em;
}
.btn:active {
  box-shadow: inset 0 0 3px rgba(0,0,0,.23);
}
.btn::before {
  display: block; position: absolute;
  left: -5em;
  content: "copié !";
  transform: rotate(-25deg) scale(1.5) translateY(-0.25rem);
  font-family: 'Indie Flower', cursive;
  color: rgba(67, 66, 65,0);
  transition-duration: 3.5s;
}
.btn:active::before {
  color: rgba(67, 66, 65,255);
  transition-duration: 0s;
}

  </style>
</head>
<body>
  <div class="container" >
    <header>
      <h1 class="site-name" >Fichiers <samp>.ics</samp> pour les séminaires de l'<a href="#irmar" >IRMAR</a></h1>
      <div class="article__content" >
        <div class="group-teaser" >
          <p>Cette page n'est pas une page officielle de l'Université de Rennes 1 et n'a aucun lien avec une quelconque instance de l'université. Il s'agit juste du boulot d'un ancien doctorant.</p>
          <p>Cette page propose des calendriers au format <samp>.ics</samp> (compatible avec iCal, Google Agenda, Outlook, Framagenda, etc.) pour les différents séminaires de l'<a href="https://irmar.univ-rennes1.fr/" >IRMAR</a>. Il s'agit d'un <i lang="en" >scraper</i> de chaque page de séminaire, donc ceci ne contient pas les autres évènements de l'IRMAR (normalement). Pour des raisons de performance et évtier de se faire ban-lister par la DSI, les informations des séminaires sont stockées dans un fichier <i lang="en">cache buffer</i> d'une durée de <?= time_buffer/3600 ?>h, il est donc normal de ne pas voir imédiatement les mises-à-jour des séminaires.</p>
          <p>Pour avoir toujours les prochaines dates des séminaires de votre équipe, il suffit d'ajouter le (ou les) lien(s) ci-dessous dans les abonnements de votre gestionnaire de calendrier favori.</p>
        </div>
      </div>
    </header>
    <main>
      <h2 id="irmar">Liste des séminaires de l'IRMAR</h2>
      <dl>
        <?php foreach ($types_colornamenum as $type => $value) {
          $ics_url = "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]."?q=".$type;
          $seminar_url = "https://irmar.univ-rennes1.fr/seminars?f[0]=seminar_type%3A".$value[2];
          if ( $value[2] == 0 ) { $seminar_url = "https://irmar.univ-rennes1.fr/seminars"; }
        ?>
          <dt><a href="<?= $seminar_url ?>" ><?= $value[1] ?></a></dt>
          <dd class='ics' ><button class='btn' data-clipboard-text="<?= $ics_url ?>">📎<span>Copier le lien</span></a></button><?= $ics_url ?></dd>
        <?php } ?>
      </dl>
    </main>
  </div>

  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/clipboard@2.0.6/dist/clipboard.min.js" ></script>
  <script type="text/javascript" >new ClipboardJS('.btn');</script>
</body>
</html>

<?php

}

?>