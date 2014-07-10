<?php
/** WeCheck API - PHP Client
  * Version 1.0
  * 
  * - Home: http://www.wecheck.net/
  * - Documentation: http://www.wecheck.net/dashboard/info/api
  *
  * All rights reserved  - (c) 2014 WeCheck - S.H.Q. B.V.
**/
namespace WeCheck;
class API extends Communicator
{
    public function setKey($key)
    { 
        $this->__set('API_KEY', $key);
    }

    public function getMonitors()
    {
        return $this->call('monitors', array('action' => 'list'));
    }

    public function getMonitorsAvailable()
    {
        return $this->call('monitors', array('action' => 'available'));
    }

    public function getMonitorDetails($monitor_id)
    {
        return $this->call('monitors', array('action' => 'details', 'id' => $monitor_id));
    }

    public function addMonitor($data)
    {
        return $this->call('monitors', array('action' => 'add', 'data' => $data));
    }

    public function editMonitor($data)
    {
        return $this->call('monitors', array('action' => 'edit', 'data' => $data));
    }

    public function contactsToMonitor($data)
    {
        return $this->call('monitors', array('action' => 'contacts', 'data' => $data));
    }

    public function pauseMonitor($monitor_id)
    {
        return $this->call('monitors', array('action' => 'pause', 'id' => $monitor_id));
    }

    public function startMonitor($monitor_id)
    {
        return $this->call('monitors', array('action' => 'start', 'id' => $monitor_id));
    }

    public function resetMonitor($monitor_id)
    {
        return $this->call('monitors', array('action' => 'reset', 'id' => $monitor_id));
    }

    public function removeMonitor($monitor_id)
    {
        return $this->call('monitors', array('action' => 'remove', 'id' => $monitor_id));
    }

    public function getContacts()
    {
        return $this->call('contacts', array('action' => 'list'));
    }

    public function getContactsAvailable()
    {
        return $this->call('contacts', array('action' => 'available'));
    }

    public function getContactDetails($contact_id)
    {
        return $this->call('contacts', array('action' => 'details', 'id' => $contact_id));
    }

    public function addContact($data)
    {
        return $this->call('contacts', array('action' => 'add', 'data' => $data));
    }

    public function editContact($data)
    {
        return $this->call('contacts', array('action' => 'edit', 'data' => $data));
    }

    public function removeContact($contact_id)
    {
        return $this->call('contacts', array('action' => 'remove', 'id' => $contact_id));
    }
}
