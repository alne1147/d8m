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
	        ORDER BY nid DESC LIMIT 0,500"
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
			'files' => $this->getFiles($nid, ['events', 'news', 'page']),
			'images' => $this->getImages($nid, ['brand_co', 'minisite_banner', 'slider_image']),
			'banner_link' => $this->getFieldData($nid, 'entity_id', 'field_data_field_url_of_banner', 'field_url_of_banner_value'),
			'image_link' => $this->getFieldData($nid, 'entity_id', 'field_data_field_image_link', 'field_image_link_value'),
			'block_opts' => $this->getBlockOpts($nid),
	      ];
	      $rows[$nid] = $row;
	      $database_info = Database::getConnection('prepare', 'default');
	      $database_info->insert('d8mprep.node')
	        ->fields($row)
	        ->execute();
	    }
  }
  private function getBlockOpts(int $nid) {
	  $database_info = Database::getConnection('legacy', 'default');
	  $option = [];
	  // 1. Fetch icon
	  $query = $database_info->query('select icon.field_icon_value from pacific.field_data_field_title_options opts left join pacific.field_data_field_icon icon on opts.field_title_options_value = icon.entity_id where opts.entity_id = :nid', [':nid' => $nid]);
	  $results = $query->fetchCol();
	  $options['icon'] = reset($results);
	  
	  // 2. Fetch color
	  // select opts.field_title_options_value, color.field_icon_color_jquery_colorpicker from field_data_field_title_options opts left join field_data_field_icon_color color on opts.field_title_options_value = color.entity_id where opts.entity_id = 3466;
	  
	  // 3. Fetch hide param
	  // select opts.field_title_options_value, hide.field_hide_title_value from field_data_field_title_options opts left join field_data_field_hide_title hide on opts.field_title_options_value = hide.entity_id where opts.entity_id = 3466;
	  
	  return serialized($options);
  }
  private function getImages (int $nid, $types = []) {
	  if (empty($types)) {
		  return '';
	  }
	  $results = [];
	  foreach ($types as $type) {
		  $table = 'field_data_field_' . $type . '_image';
		  $field = 'field_' . $type . '_image_fid';
	      $database_info = Database::getConnection('legacy', 'default');
	      $query = $database_info->query('SELECT ' . $field . ' from pacific.' . $table . ' WHERE entity_id is not null and entity_id = :nid', [':nid' => $nid]);
	      $results = array_merge($results, $query->fetchCol());
	  }
	  return implode(',', $results);
      
  }
  
  private function getFiles (int $nid, $types = []) {
	  if (empty($types)) {
		  return '';
	  }
	  $results = [];
	  foreach ($types as $type) {
		  $table = 'field_data_field_minisite_' . $type . '_files';
		  $field = 'field_minisite_' . $type . '_files_fid';
	      $database_info = Database::getConnection('legacy', 'default');
	      $query = $database_info->query('SELECT ' . $field . ' from pacific.' . $table . ' WHERE entity_id is not null and entity_id = :nid', [':nid' => $nid]);
	      $results = array_merge($results, $query->fetchCol());
	  }
	  return implode(',', $results);
      
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