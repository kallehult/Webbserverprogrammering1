# Webbutveckling1

HEJ

Börja med att fundera över hur man kan organisera projektet så att det blir tydligare lager i filstrukturen. 

En vanlig grund är att dela in filerna enligt en MVC (Model, View, Controller)-liknande struktur

Model:
I ditt Modell lager så bör all kod vara OO, alltså classes, interfaces osv. 
Fundera över vilka domänobjekt du har och skapa upp databärande objekt som representerar dessa. 
T.ex: 
<?PHP 

class Product {
  /** @var int */
  private $id;
  ....
  
  public function getId()
  {
    return $this->id;
  }
  
  public function setId($id)
  {
    $this->id = $id;
  }
  
  ...
  
}

Skapa även upp klasser för att hantera databasfrågor, så att dessa blir återanvändbara och inte blandas in direkt i ditt View lager


View:

Detta får bli dina html, css, och javascript filer. Fundera över ifall dina Controllers kan "feeda" dessa filer med information från dina domän-objekt.


Controller:
Detta är din väg in och ut i komunikationen med användarens klient. Alltså det är här du tar emot requests samt svarar på request med lämplig data, så som html eller JSON. 
Undvik domain logic här. Lämna det till Modellagret. 



