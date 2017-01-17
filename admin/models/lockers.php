<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
/**
 * LockersList Model
 *
 * @since  0.0.1
 */
class LockersModelLockers extends JModelList
{
        	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @see     JController
	 * @since   1.6
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id','l.id',
				'MemberFirstname','m.MemberFirstname',
				'MemberSurname','m.MemberSurname',
				'LockerNumber','l.LockerNumber'
			);
		}
 
		parent::__construct($config);
	}
       
	
	//override default list
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication();
	
		// List state information
		$limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->get('list_limit'));
	
		$limit = 50;  // set list limit
	
		// set filters
		$value = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $value);
		
		parent::populateState('l.LockerNumber', 'asc');
	}
        
	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return      string  An SQL query
	 */
	protected function getListQuery()
	{
		// Initialize variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
 
		// Create the base select statement.
		$query->select('l.*,concat(m.MemberFirstname,\' \',m.MemberSurname) as membername, m.MemberFirstname, m.MemberSurname');               
                $query->from('lockers AS l');  // use new osclockers table
                $query->leftJoin('oscmembers AS m ON l.MemberID = m.id'); // Use new member table
                
                		// Filter: like / search
		$search = $this->getState('filter.search');
 
		if (!empty($search))
		{
			//$like = $db->quote('%' . $search . '%');
			$search = $db->quote('%' . str_replace(' ', '%', $db->escape(trim($search), true) . '%'));
			//$query->where('m.membername LIKE ' . $like);
			$query->where('((m.MemberFirstname LIKE ' . $search . ') OR (m.MemberSurname LIKE ' . $search . ')) ');
		}
 

 
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering','l.LockerNumber');
		$orderDirn 	= $this->state->get('list.direction','asc');
 
		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
 
		return $query;
	}
	
	
}