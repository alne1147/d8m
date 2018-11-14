<?php
/**
 * @file
 * Contains \Drupal\ci_migrate\Controller\DbMove.
 */

namespace Drupal\ci_migrate\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\node\Entity\Node;
use Drupal\media\Entity\Media;
use Drupal\paragraphs\Entity\Paragraph;

class DbMove extends ControllerBase {

  /**
   * @inheritdoc
   */
  protected function defaultDatabase($type = 'default') {
    $database_info = Database::getConnection($type, 'default');
    return $database_info;
  }

  public function etl() {
	$database_info = Database::getConnection('legacy', 'default');
	$query = $database_info->query(
	      "SELECT nid, vid, type, language, uid, status, title, created, changed
	        FROM pacific.node
	        ORDER BY nid DESC LIMIT 0,50"
	    );
	    $results = $query->fetchAll();
	    $row = [];
	    foreach ($results as $key => $value) {
	      $nid = $value->nid;
	      $row = [
	        'nid' => $nid,
	        'type' => $value->type,
	        'created' => $value->created,
	        'changed' => $value->changed,
	        'dest_type' => $this->getDestType($value->type, $nid),
	        'title' => $value->title,
	        'body' => $this->getFieldData($nid, 'entity_id', 'field_data_body', 'body_value'),
	        'teaser' => $this->getFieldData($nid, 'entity_id', 'field_data_body', 'body_summary'),
	        'uid' => ($value->uid) ? $value->uid : 6,
	        'alias' => $this->getAlias($nid),
	        'status' => $value->status,
	        'language' => $value->language,
			'og_audience' => $this->getFieldData($nid, 'etid', 'og_membership', 'gid'),
	      ];
	      $rows[$nid] = $row;
	      $database_info = Database::getConnection('prepare', 'default');
	      $database_info->insert('d8mprep.node')
	        ->fields($row)
	        ->execute();
	    }
  }
  
  private function getFieldData(int $nid, $entity_field = 'nid', string $table, string $field, bool $trim = false) {
      $database_info = Database::getConnection('legacy', 'default');
      $query = $database_info->query('SELECT cf.' . $field . ' from pacific.node n inner join pacific.' . $table . ' cf on n.nid = cf.' . $entity_field . ' WHERE cf.' . $field . ' is not null and n.nid = :nid', [':nid' => $nid]
      );
      $results = $query->fetchCol();
      $formatted = implode(',', str_replace(["'", ";"], ["\'", ","], $results));
      if (strlen($formatted) > 255 && $trim) {
        $formatted = '';
      }
      return $formatted;
    }
	
	private function getAlias(int $nid) {
	    $alias = NULL;
	    $database_info = Database::getConnection('legacy', 'default');
	    $query = $database_info->query('SELECT alias from pacific.url_alias WHERE source = :nid', [':nid' => 'node/' . $nid]
	    );
	    $results = $query->fetchCol();
	    if (!empty($results)) {
	      $alias = '/' . reset($results);
	    }
	    return $alias;
	  }
	  
	  private function getDestType(string $type, int $nid) {

	      switch ($type) {
	        default:
	        $dest_type = $type;
	      }

	      return $dest_type;
	    }

}