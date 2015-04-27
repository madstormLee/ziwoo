<?
class Contents extends MadModel {
	protected $types = array();

	function __construct( $id='' ) {
		$this->parentId = 0;
		$this->setSetting('contents/model.json');
		parent::__construct( $id );
		if ( empty($this->id) ) {
			$this->setDefault();
		}
	}
	function setDefault() {
		$this->data = $this->setting->dic('default')->getData();
		return $this;
	}
	function getStack( $parentId=0 ) {
		$query = "select * from Contents where parentId=$parentId and type='stack'";
		return $this->getDb()->query($query)->fetchAll(PDO::FETCH_CLASS);
	}
	function fetch( $id='' ) {
		if ( empty( $id ) ) {
			return $this;
		}
		$query = new MadQuery(get_class($this));
		$query->where( "id=$id" );

		$db = $this->getDb();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->data = $db->query( $query )->fetch(PDO::FETCH_ASSOC);
		return $this;
	}
	function getPersona() {
		return new MadData;
	}
	function getStatuses() {
		return new MadJson('project/statuses.json');
	}
	function getCategories() {
		return $this->setting->category->options;
	}
	function save() {
		if ( $this->id ) {
			return $this->update();
		}
		return $this->insert();
	}
	function getDb() {
		return MadConfig::getInstance()->db;
	}
	function insert() {
		$this->wDate = date('Y-m-d H:i:s');
		$this->uDate = date('Y-m-d H:i:s');

		$query = new MadQuery( get_class($this) );
		$query->insert( array_filter($this->data) );

		$db = $this->getDb();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$statement = $db->prepare( $query );
		$result = $statement->execute( $query->data() );
		return $db->lastInsertId();
	}
	function update() {
		$this->uDate = date('Y-m-d H:i:s');

		$query = new MadQuery( get_class($this) );
		$query->update( $this->data );

		$db = $this->getDb();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$statement = $db->prepare( $query );
		$result = $statement->execute( $query->data() );

		return $statement->rowCount();
	}
	function delete( $id='' ) {
		$query = "delete from Contents where id=?";

		$db = $this->getDb();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$statement = $db->prepare( $query );
		$result = $statement->execute( array($id) );

		return $statement->rowCount();
	}
}
