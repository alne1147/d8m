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
  
  public function etlUsers() {
  	$database_info = Database::getConnection('legacy', 'default');
	$query = $database_info->query('SELECT * FROM pacific.users');
	$results = $query->fetchAll();
	foreach ($results as $key => $value) {
		$user = [];
		$uid = $value->uid;
		$user['uid'] = $uid;
		$user['name'] = $value->name;
		$user['pass'] = $value->pass;
		$user['mail'] = $value->mail;
		$user['status'] = $value->status;
		$user['init'] = $value->init;
		$user['created'] = $value->created;
		
		$roles = $database_info->query('SELECT rid FROM pacific.users_roles WHERE uid = :uid', [':uid' => $uid])->fetchCol();
		$user['roles'] = implode(',', $roles);
		$og_roles = $database_info->query('SELECT rid FROM pacific.og_users_roles WHERE uid = :uid', [':uid' => $uid])->fetchCol();
		$user['og_roles'] = implode(',', $og_roles);
		$user['first_name'] = $this->getUserFieldData($uid, 'entity_id', 'field_data_field_first_name', 'field_first_name_value');
		$user['last_name'] = $this->getUserFieldData($uid, 'entity_id', 'field_data_field_last_name', 'field_last_name_value');
		
		$user['minisite_nids'] = $this->getUserFieldData($uid, 'etid', 'og_membership', 'gid');
		$database_info->insert('d8mprep.user')
          ->fields($user)
          ->execute();
	}
  }

  public function etlTerms() {
	$database_info = Database::getConnection('legacy', 'default');
	$query = $database_info->query(
	      "select td.vid, v.name as vocabulary, v.machine_name, td.tid, td.name, td.description, td.weight, th.parent
			from pacific.taxonomy_term_data td
			left join pacific.taxonomy_term_hierarchy th
		  	on td.tid = th.tid
			left join pacific.taxonomy_vocabulary v
			on v.vid = td.vid"
	    );
	    $results = $query->fetchAll();
	    $row = [];
	    foreach ($results as $key => $value) {
	      $nid = $value->nid;
	      $row = [
	        'tid' => $value->tid,
	        'term_name' => $value->name,
	        'vid' => $value->vid,
			'vocabulary' => $value->vocabulary,
			'vocabulary_machine' => $value->machine_name,
			'description' => $value->description,
			'weight' => $value->weight,
			'parent' => $value->parent
	      ];
	      $rows[$nid] = $row;
	      $database_info = Database::getConnection('prepare', 'default');
	      $database_info->insert('d8mprep.term')
	        ->fields($row)
	        ->execute();
	    }
  }

  public function etlNodes() {
	$database_info = Database::getConnection('legacy', 'default');
	$query = $database_info->query(
	      "SELECT nid, vid, type, language, uid, status, title, created, changed
	        FROM pacific.node
		  # WHERE nid > 111801
	        ORDER BY nid ASC"
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
					'minisite_nids' => $this->getFieldData($nid, 'etid', 'og_membership', 'gid'),
					'files' => $this->getFiles($nid, ['events', 'news', 'page']),
					'images' => $this->getImages($nid, ['brand_co', 'minisite_banner', 'slider_image']),
					'banner_link' => $this->getFieldData($nid, 'entity_id', 'field_data_field_url_of_banner', 'field_url_of_banner_value'),
					'image_link' => $this->getFieldData($nid, 'entity_id', 'field_data_field_image_link', 'field_image_link_value'),
					'optional_link' => $this->getFieldData($nid, 'entity_id', 'field_data_field_optional_link', 'field_optional_link_value'),
					'block_opts' => $this->getBlockOpts($nid),
					'event_date' => $this->getEventDate($nid),
					'footer_link' => $this->getFieldData($nid, 'entity_id', 'field_data_field_minisite_footer_link_url', 'field_minisite_footer_link_url_value'),
					'driving_url' => $this->getFieldData($nid, 'entity_id', 'field_data_field_minisite_driving_url', 'field_minisite_driving_url_value'),
					'driving_cat_tid' => intval($this->getFieldData($nid, 'entity_id', 'field_data_field_minisite_driving_category', 'field_minisite_driving_category_tid')),
					'executive_office_tid' => intval($this->getFieldData($nid, 'entity_id', 'field_data_field_executive_office', 'field_executive_office_tid')),
					'state_agency_tid' => intval($this->getFieldData($nid, 'entity_id', 'field_data_field_state_agency', 'field_state_agency_tid')),
					'text_area_type_tid' => intval($this->getFieldData($nid, 'entity_id', 'field_data_field_minisite_text_area_type', 'field_minisite_text_area_type_tid')),
					'minisite' => $this->getFieldData($nid, 'id', 'purl', 'value'),
					'social_link' => $this->getFieldData($nid, 'entity_id', 'field_data_field_minisite_social_link_netwk', 'field_minisite_social_link_netwk_value'),
					'minisite_social_link' => $this->getFieldData($nid, 'entity_id', 'field_data_field_minisite_social_link_url', 'field_minisite_social_link_url_value'),
	      ];
	      $database_info = Database::getConnection('prepare', 'default');
	      $database_info->insert('d8mprep.node')
	        ->fields($row)
	        ->execute();
	    }
  }

  private function getEventDate(int $nid) {
      $database_info = Database::getConnection('legacy', 'default');
      $query = $database_info->query('SELECT field_minisite_event_date_value, field_minisite_event_date_value2 from pacific.field_data_field_minisite_event_date WHERE entity_id is not null and entity_id = :nid', [':nid' => $nid]
      );
      $results = $query->fetchAll();
	  if (count($results)) {
		  return $results[0]->field_minisite_event_date_value . '~' . $results[0]->field_minisite_event_date_value2;
	  }
      return '';
    }

  private function getBlockOpts(int $nid) {
	  $database_info = Database::getConnection('legacy', 'default');
	  $option = [];
	  // 1. Fetch icon
	  $query = $database_info->query('select icon.field_icon_value from pacific.field_data_field_title_options opts left join pacific.field_data_field_icon icon on opts.field_title_options_value = icon.entity_id where opts.entity_id = :nid', [':nid' => $nid]);
	  $results = $query->fetchCol();
	  $options['icon'] = reset($results);

	  // 2. Fetch color
	  $query = $database_info->query('select icon.field_icon_color_jquery_colorpicker from pacific.field_data_field_title_options opts left join pacific.field_data_field_icon_color icon on opts.field_title_options_value = icon.entity_id where opts.entity_id = :nid', [':nid' => $nid]);
	  $results = $query->fetchCol();
	  $options['color'] = reset($results);

	  // 3. Fetch hide param
	  $query = $database_info->query('select icon.field_hide_title_value from pacific.field_data_field_title_options opts left join pacific.field_data_field_hide_title icon on opts.field_title_options_value = icon.entity_id where opts.entity_id = :nid', [':nid' => $nid]);
	  $results = $query->fetchCol();
	  $options['hide'] = reset($results);

	  return serialize($options);
  }
  private function getImages (int $nid, $types = []) {
	  if (empty($types)) {
		  return '';
	  }
	  $results = [];
	  foreach ($types as $type) {
		  $table = 'field_data_field_' . $type . '_image';
		  $field = 'field_' . $type . '_image_fid';

			$uris = $this->getFileURI($field, $table, $nid);
			$results = array_merge($results, $uris);
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

			$uris = $this->getFileURI($field, $table, $nid);
			$results = array_merge($results, $uris);
	  }
	  return implode(',', $results);

	}

	private function getFileURI($field, $table, $nid) {
		$database_info = Database::getConnection('legacy', 'default');

			$query = $database_info->query(
				'SELECT files.uri'
				. ' FROM pacific.' . $table
				. ' JOIN file_managed as files'
				. ' ON files.fid = ' . $field
				. ' WHERE entity_id is not null and entity_id = :nid', [':nid' => $nid]
			);

			return $query->fetchCol();
	}

  private function getUserFieldData(int $uid, $entity_field = 'entity_id', string $table, string $field, bool $trim = false) {
      $database_info = Database::getConnection('legacy', 'default');
      $query = $database_info->query('SELECT cf.' . $field . ' from pacific.users u inner join pacific.' . $table . ' cf on u.uid = cf.' . $entity_field . ' WHERE cf.' . $field . ' is not null and u.uid = :uid', [':uid' => $uid]
      );
      $results = $query->fetchCol();
      $formatted = implode(',', str_replace(["'", ";"], ["\'", ","], $results));
      if (strlen($formatted) > 255 && $trim) {
        $formatted = '';
      }
      return $formatted;
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
          case 'slider_image':
            $dest_type = 'jumbo_slides';
            break;
          case 'minisite_page':
            $dest_type = 'page';
            break;
          case 'minisite_news':
          case 'blog':
            $dest_type = 'article';
            break;
          case 'minisite':
            $dest_type = 'landing_page';
            break;
	        default:
	          $dest_type = $type;
	      }

	      return $dest_type;
	    }

}
