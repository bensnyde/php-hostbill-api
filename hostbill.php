<?php

// http://api.hostbillapp.com/
class Hostbill {
    private $api_url;
    private $api_id;
    private $api_key;

    public function __construct($api_url,$api_id,$api_key) {
        $this->api_url = $api_url;
        $this->api_id = $api_id;
        $this->api_key = $api_key;
    }

    /**
     * Internal method to call remote HostBill API using cURL
     * @param array $post
     * @return json
     */
    private function hbQuery($post) {
        $post['outputformat']='json';
        $post['api_id']=  $this->api_id;
        $post['api_key']= $this->api_key;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    // ******** General ***********

    /**
     * Return list of all available methods
     * @return json
     */
    public function getAPIMethods()
    {
        $data['call'] = "getAPIMethods";
        return $this->hbQuery($data);
    }

    /**
     * Return installed HostBill version
     * @return json
     */
    public function getHostBillversion()
    {
        $data['call'] = "getHostBillversion";
        return $this->hbQuery($data);
    }

    // ******** Clients ***********

    /**
     * Get client details
     * @param  [string] $id Client ID
     * @return json
     */
    public function getClientDetails($id)
    {
        $data['call'] = "getClientDetails";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Set client details
     * @param [string] $id
     * @param [array] $firstname firstname, lastname, companyname, address1, address2, city, state, postcode, country, phonenumber
     * @return json
     */
    public function setClientDetails($id, Array $optional = array())
    {
        foreach($optional as $key=>$value)
            $data[$key] = $value;

        $data['call'] = "setClientDetails";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Get list of all clients
     * @return json
     */
    public function getClients()
    {
        $data['call'] = "getClients";
        return $this->hbQuery($data);
    }

    /**
     * Get list of client's orders
     * @param  [string] $id
     * @return json
     */
    public function getClientOrders($id)
    {
        $data['call'] = "getClientOrders";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Get list of contacts created under client's profile
     * @param  [string] $id
     * @return json
     */
    public function getClientContacts($id)
    {
        $data['call'] = "getClientContacts";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Get client statistics
     * @param  [string] $id
     * @return json
     */
    public function getClientStatistics($id)
    {
        $data['call'] = "getClientStatistics";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Get list of client's accounts
     * @param  [string] $id
     * @return json
     */
    public function getClientAccounts($id)
    {
        $data['call'] = "getClientAccounts";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Get list of client's transactions
     * @param  [string] $id
     * @return json
     */
    public function getClientTransactions($id)
    {
        $data['call'] = "getClientTransactions";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Get list of client's invoices
     * @param  [string] $id
     * @return json
     */
    public function getClientInvoices($id)
    {
        $data['call'] = "getClientInvoices";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Get list of client's domains
     * @param  [string] $id
     * @return json
     */
    public function getClientDomains($id)
    {
        $data['call'] = "getClientDomains";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Get list of emails sent to client
     * @param  [string] $id
     * @return json
     */
    public function getClientEmails($id)
    {
        $data['call'] = "getClientEmails";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Get list of client's support tickets
     * @param  [string] $id
     * @return json
     */
    public function getClientTickets($id)
    {
        $data['call'] = "getClientTickets";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Delete client
     * @param  [string] $id
     * @return json
     */
    public function deleteClient($id)
    {
        $data['call'] = "deleteClient";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Delete contact from client profile
     * @param  [string] $client_id [Contact ID to remove]
     * @param  [string] $parent_id [Client main profile ID contact is removed from]
     * @return json
     */
    public function deleteClientContact($client_id, $parent_id)
    {
        $data['call'] = "deleteClientContact";
        $data['client_id'] = $client_id;
        $data['parent_id'] = $parent_id;
        return $this->hbQuery($data);
    }

    /**
     * Creates new client
     * @param [string] $firstname
     * @param [string] $lastname
     * @param [string] $email
     * @param [string] $password
     * @param [string] $password2
     * @param array  $optional notify,phonenumber,type,address1,address2,city,state,postcode,country,companyname
     * @return json
     */
    public function addClient($firstname, $lastname, $email, $password, $password2, Array $optional = array())
    {
        // Add defined optional parameters to datagram
        foreach($optional as $key=>$value)
            $data[$key] = $value;

        $data['call'] = "addClient";
        $data['firstname'] = $firstname;
        $data['lastname'] = $lastname;
        $data['email'] = $email;
        $data['password'] = $password;
        $data['password2'] = $password2;
        return $this->hbQuery($data);
    }

    /**
     * Creates new contact under client profile
     * @param [string] $id Main client ID
     * @param [string] $firstname
     * @param [string] $lastname
     * @param [string] $email
     * @param [string] $password
     * @param [string] $password2
     * @param array  $optional phonenumber,address1,address2,city,state,postcode,country,prvileges
     * @return json
     */
    public function addClientContact($id, $firstname, $lastname, $email, $password, $password2, Array $optional = array())
    {
        // Add defined optional parameters to datagram
        foreach($optional as $key=>$value)
            $data[$key] = $value;

        $data['call'] = "addClientContact";
        $data['id'] = $id;
        $data['firstname'] = $firstname;
        $data['lastname'] = $lastname;
        $data['email'] = $email;
        $data['password'] = $password;
        $data['password2'] = $password2;
        return $this->hbQuery($data);
    }

    /**
     * Add credit card to client profile
     * @param  [string] $id
     * @param  [string] $cardnum
     * @param  [string] $cardtype
     * @param  [string] $expiryyear
     * @param  [string] $expirymonth
     * @return json
     */
    public function editClientCreditCard($id, $cardnum, $cardtype, $expiryyear, $expirymonth)
    {
        $data['call'] = "editClientCreditCard";
        $data['id'] = $id;
        $data['cardnum'] = $cardnum;
        $data['cardtype'] = $cardtype;
        $data['expiryyear'] = $expiryyear;
        $data['expirymonth'] = $expirymonth;
        return $this->hbQuery($data);
    }

    /**
     * Verify client login. If client with username & password exist in db, his ID will be returned
     * @param  [string] $email
     * @param  [string] $password
     * @return json
     */
    public function verifyClientLogin($email, $password)
    {
        $data['call'] = "verifyClientLogin";
        $data['email'] = $email;
        $data['password'] = $password;
        return $this->hbQuery($data);
    }

    /**
     * Add credit(funds) to client profile.
     * @param [type] $client_id
     * @param [type] $amount
     * @return json
     */
    public function addClientCredit($client_id, $amount)
    {
        $data['call'] = "addClientCredit";
        $data['client_id'] = $client_id;
        $data['amount'] = $amount;
        return $this->hbQuery($data);
    }

    /**
     * List files assigned with client profile
     * @param  [string] $client_id
     * @return json
     */
    public function getClientFiles($client_id)
    {
        $data['call'] = "getClientFiles";
        $data['client_id'] = $client_id;
        return $this->hbQuery($data);
    }

    /**
     * Add file (with data) to client profile. Returned is newly created file id
     * @param [string]  $client_id
     * @param [string]  $data [Base64 encoded data]
     * @param [string]  $name [How this file should appear in interface]
     * @param [string]  $filename [Original filename with extension]
     * @param [int] $admin_only [Set to 1 if file should be visible to admins only]
     * @return json
     */
    public function addClientFile($client_id, $data, $name, $filename, $admin_only=0)
    {
        $data['call'] = "addClientFile";
        $data['client_id'] = $client_id;
        $data['data'] = base64_encode($data);
        $data['name'] = $name;
        $data['filename'] = $filename;
        $data['admin_only'] = $admin_only;
        return $this->hbQuery($data);
    }

    /**
     * Delete file from client profile
     * @param  [string] $client_id
     * @param  [string] $file_id
     * @return json
     */
    public function deleteClientFile($client_id, $file_id)
    {
        $data['call'] = "deleteClientFile";
        $data['client_id'] = $client_id;
        $data['file_id'] = $file_id;
        return $this->hbQuery($data);
    }

    /**
     * Tokenize client Credit . Client credit card on file will be replaced with token, only 4 digits of credit card
     * @param  [string] $client_id
     * @param  [string] $gateway_id
     * @param  [string] $token
     * @return json
     */
    public function tokenizeClientCard($client_id, $gateway_id, $token)
    {
        $data['call'] = "tokenizeClientCard";
        $data['client_id'] = $client_id;
        $data['gateway_id'] = $gateway_id;
        $data['token'] = $token;
        return $this->hbQuery($data);
    }

    // ******** Billing/Invoicing ***********

    /**
     * Get list of invoices.
     * @param  string $list [Status of invoices to list: all, paid, unpaid, cancelled]
     * @return json
     */
    public function getInvoices($list="all")
    {
        $data['call'] = "getInvoices";
        $data['list'] = $list;
        return $this->hbQuery($data);
    }

    /**
     * Get list of invoices in pdf format, each returned file is base64 encoded
     * @param  [string] $invoices [List of invoice IDs]
     * @param  [string] $from     [Date from]
     * @param  [string] $to       [Date to]
     * @return json
     */
    public function getInvoicesPDF($invoices=null, $from=null, $to=null)
    {
        $data['call'] = "getInvoicesPDF";
        $data['invoices'] = $invoices;
        $data['from'] = $from;
        $data['to'] = $to;
        return $this->hbQuery($data);
    }

    /**
     * Return invoice details
     * @param  [string] $id
     * @return json
     */
    public function getInvoiceDetails($id)
    {
        $data['call'] = "getInvoiceDetails";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Change invoice status
     * @param [string] $id
     * @param [string] $status [New invoice status, possible values: Paid, Unpaid, Cancelled]
     * @return json
     */
    public function setInvoiceStatus($id, $status)
    {
        $data['call'] = "setInvoiceStatus";
        $data['id'] = $id;
        $data['status'] = $status;
        return $this->hbQuery($data);
    }

    /**
     * Edit invoice details
     * @param  [string] $id       [description]
     * @param  array  $optional [credit, date, duedate, payment_module, taxrate, taxrate2]
     * @return json
     */
    public function editInvoiceDetails($id, Array $optional = array())
    {
        foreach($optional as $key=>$value)
            $data[$key] = $value;

        $data['call'] = "editInvoiceDetails";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Delete Invoice
     * @param  [string] $id
     * @return json
     */
    public function deleteInvoice($id)
    {
        $data['call'] = "deleteInvoice";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Send invoice to customer
     * @param  [string] $id
     * @return json
     */
    public function sendInvoice($id)
    {
        $data['call'] = "sendInvoice";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Creates new invoice. Note: New invoice status will be set to DRAFT, so customer wont be able to see it, after finishing work with invoice you can make it viewable by changing its status to Unpaid
     * @param  [string] $client_id
     * @return json
     */
    public function createInvoice($client_id)
    {
        $data['call'] = "createInvoice";
        $data['client_id'] = $client_id;
        return $this->hbQuery($data);
    }

    /**
     * Add new line/item to invoice
     * @param [string]  $id    [Invoice ID]
     * @param [string]  $line  [Description of new invoice item]
     * @param [string]  $price
     * @param integer $qty
     * @param integer $tax   [Indicates whether item is taxed (1) or not (0)]
     * @return json
     */
    public function addInvoiceItem($id, $line, $price, $qty=1, $tax=1)
    {
        $data['call'] = "addInvoiceItem";
        $data['id'] = $id;
        $data['line'] = $line;
        $data['price'] = $price;
        $data['qty'] = $qty;
        $data['tax'] = $tax;
        return $this->hbQuery($data);
    }

    /**
     * Submit new payment (transaction) to invoice
     * @param [type] $id            [Invoice ID]
     * @param [type] $amount        [Transaction amount]
     * @param [type] $paymentmodule [ID of related payment gateway]
     * @param [type] $fee           [Fees applied to payment (0 for no fees)]
     * @param [type] $date          [Transaction date]
     * @return json
     */
    public function addInvoicePayment($id, $amount, $paymentmodule, $fee, $date)
    {
        $data['call'] = "addInvoicePayment";
        $data['id'] = $id;
        $data['amount'] = $amount;
        $data['paymentmodule'] = $paymentmodule;
        $data['fee'] = $fee;
        $data['date'] = $date;
        return $this->hbQuery($data);
    }

    /**
     * Charge customers credit card on file for full invoice due balance
     * @param  [string] $id [Invoice ID]
     * @return json
     */
    public function chargeCreditCard($id)
    {
        $data['call'] = "chargeCreditCard";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Add usage for metered billing variable
     * @param  [string] $account_id [HostBill account ID that usage is being added]
     * @param  [string] $variable   [Name of variable that usage of is being added. I.e: bandwidth]
     * @param  [string] $qty        [Quantity of usage to record]
     * @param  array  $optional   [output, rawoutput, charge, date_created]
     * @return json
     */
    public function meteredAddUsage($account_id, $variable, $qty, Array $optional = array())
    {
        foreach($optional as $key=>$value)
            $data[$key] = $value;

        $data['call'] = "meteredAddUsage";
        $data['account_id'] = $account_id;
        $data['variable'] = $variable;
        $data['qty'] = $qty;
        return $this->hbQuery($data);
    }

    /**
     * Get usage of metered billing components for certain HostBill account in current billing period
     * @param  [string] $account_id [HostBill account ID]
     * @return json
     */
    public function meteredGetUsage($account_id)
    {
        $data['call'] = "meteredGetUsage";
        $data['account_id'] = $account_id;
        return $this->hbQuery($data);
    }

    /**
     * Get metered billing components available for product in HostBill.
     * @param  [string] $product_id
     * @return json
     */
    public function meteredGetVariables($product_id)
    {
        $data['call'] = "meteredGetVariables";
        $data['product_id'] = $product_id;
        return $this->hbQuery($data);
    }

    // ******** Orders ***********

    /**
     * Get list of orders.
     * @param  [string] $list [Status of orders to list, possible values: all, active, pending, fraud, cancelled]
     * @return json
     */
    public function getOrders($list="all")
    {
        $data['call'] = "getOrders";
        $data['list'] = $list;
        return $this->hbQuery($data);
    }

    /**
     * Return order details
     * @param  [string] $id [Order ID]
     * @return json
     */
    public function getOrderDetails($id)
    {
        $data['call'] = "getOrderDetails";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Change order status to pending
     * @param [string] $id [Order ID]
     * @return json
     */
    public function setOrderPending($id)
    {
        $data['call'] = "setOrderPending";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Activate order
     * @param [string] $id [Order ID]
     * @return json
     */
    public function setOrderActive($id)
    {
        $data['call'] = "setOrderActive";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Cancel order
     * @param [string] $id [Order ID]
     */
    public function setOrderCancel($id)
    {
        $data['call'] = "setOrderCancel";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Change order status to fraud
     * @param [string] $id [Order ID]
     */
    public function setOrderFraud($id)
    {
        $data['call'] = "setOrderFraud";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Delete order with harddelete = ON (If related accoutns are active, they will be terminated!)
     * @param  [string] $id [Order ID]
     * @return json
     */
    public function deleteOrder($id)
    {
        $data['call'] = "deleteOrder";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Create new order on customer behalf
     * @param [string]  $client_id        [Client ID]
     * @param integer $confirm          [Set to 1 if you wish to notify client about this order]
     * @param integer $invoice_generate [Set to 1 if you wish to generate invoice for this order]
     * @param integer $invoice_info     [Set to 1 if you wish to send invoice generated for this order]
     * @param array   $optional
     * Ordering domain reg/xfer: module,domain_action,domain_sld,domain_period,domain_tld,product,domain_dns,domain_email,domain_idp,coupon
     * Ordering product/service:
     * module,product,domain_name,cycle,coupon
     * @return json
     */
    public function addOrder($client_id, $confirm=1, $invoice_generate=1, $invoice_info=1, Array $optional = array())
    {
        foreach($optional as $key=>$value)
            $data[$key] = $value;

        $data['call'] = "addOrder";
        $data['client_id'] = $client_id;
        $data['confirm'] = $confirm;
        $data['invoice_generate'] = $invoice_generate;
        $data['invoice_info'] = $invoice_info;
        return $this->hbQuery($data);
    }

    /**
     * Create new order for account upgrades
     * @param  [type] $id       [Account ID]
     * @param  [type] $new      [Product Id of package we will be upgrading to]
     * @param  array  $optional [new_cycle, module]
     * @return json
     */
    public function orderUpgrade($id, $new, Array $optional = array())
    {
        foreach($optional as $key=>$value)
            $data[$key] = $value;

        $data['call'] = "orderUpgrade";
        $data['id'] = $id;
        $data['new'] = $new;
        return $this->hbQuery($data);
    }

    /**
     * Create new order for account configuration upgrades
     * @param  [string] $id       [description]
     * @param  [string] $new      [New value for this category. CAT_ID refers to custom form category id]
     * @param  array  $optional [new[CAT_ID2], module]
     * @return json
     */
    public function orderConfigUpgrade($id, $new, Array $optional = array())
    {
         foreach($optional as $key=>$value)
            $data[$key] = $value;

        $data['call'] = "orderConfigUpgrade";
        $data['id'] = $id;
        $data['new[CAT_ID1]'] = $new;
        return $this->hbQuery($data);
    }

    // ******** Accounts ***********

    /**
     * Get list of accounts
     * @param  string $list [Status of accounts to list, possible values: all, active, pending]
     * @return json
     */
    public function getAccounts($list="all")
    {
        $data['call'] = "getAccounts";
        $data['list'] = $list;
        return $this->hbQuery($data);
    }

    /**
     * Return account details. Warning.: This method returns decrypted account password
     * @param  [string] $id [Account ID]
     * @return json
     */
    public function getAccountDetails($id)
    {
        $data['call'] = "getAccountDetails";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Invoke account create method
     * @param  [string] $id [Account ID]
     * @return json
     */
    public function accountCreate($id)
    {
        $data['call'] = "accountCreate";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Invoke account suspend method.
     * @param  [string] $id [Account ID]
     * @return json
     */
    public function accountSuspend($id)
    {
        $data['call'] = "accountSuspend";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Invoke account unsuspend method.
     * @param  [string] $id [Account ID]
     * @return json
     */
    public function accountUnsuspend($id)
    {
        $data['call'] = "accountUnsuspend";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Invoke account terminate method.
     * @param  [string] $id [Account ID]
     * @return json
     */
    public function accountTerminate($id)
    {
        $data['call'] = "accountTerminate";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * This method will only change values that are included in the request
     * @param  [string] $id       [Account ID]
     * @param  array  $optional [product_id,date_created,domain,server_id,payment_module,firstpayment,total,next_due,status,username,password,rootpassword,notes]
     * @return json
     */
    public function editAccountDetails($id, Array $optional = array())
    {
        foreach($optional as $key=>$value)
            $data[$key] = $key;

        $data['call'] = "editAccountDetails";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    // ******** Services ***********

    /**
     * Get list of addons.
     * @return json
     */
    public function getAddons()
    {
        $data['call'] = "getAddons";
        return $this->hbQuery($data);
    }

    /**
     * Return addon details
     * @param  [string] $id [Addon ID]
     * @return json
     */
    public function getAddonDetails($id)
    {
        $data['call'] = "getAddonDetails";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Get list of defined orderpages
     * @return json
     */
    public function getOrderPages()
    {
        $data['call'] = "getOrderPages";
        return $this->hbQuery($data);
    }

    /**
     * List services from orderpage.
     * @param  [string] $id [Orderpage ID]
     * @return json
     */
    public function getProducts($id)
    {
        $data['call'] = "getProducts";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Get product details
     * @param  [string] $id [Product ID]
     * @return json
     */
    public function getProductDetails($id)
    {
        $data['call'] = "getProductDetails";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Get list of addons that can be and are applied to certain product.
     * @param  [string] $id [Product ID]
     * @return json
     */
    public function getProductApplicableAddons($id)
    {
        $data['call'] = "getProductApplicableAddons";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Get list of products that can be and are applied as upgrade to certain product.
     * @param  [string] $id [Product ID]
     * @return json
     */
    public function getProductUpgrades($id)
    {
        $data['call'] = "getProductUpgrades";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    // ******** Domains ***********

    /**
     * Get list of domains.
     * @param  string $list [Status of domains to list: all, active, expired, pending, pending_transfer, pending_registration]
     * @return json
     */
    public function getDomains($list="all")
    {
        $data['call'] = "getDomains";
        $data['list'] = $list;
        return $this->hbQuery($data);
    }

    /**
     * Return domain details
     * @param  [string] $id [Domain ID]
     * @return json
     */
    public function getDomainDetails($id)
    {
        $data['call'] = "getDomainDetails";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Invoke register command on domain's related module
     * @param  [string] $id [Domain ID]
     * @return json
     */
    public function domainRegister($id)
    {
        $data['call'] = "domainRegister";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Invoke transfer command on domain's related module
     * @param  [string] $id [Domain ID]
     * @return json
     */
    public function domainTransfer($id)
    {
        $data['call'] = "domainTransfer";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Invoke renew command on domain's related module
     * @param  [string] $id [Domain ID]
     * @return json
     */
    public function domainRenew($id)
    {
        $data['call'] = "domainRenew";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Invoke domain synchronization Hostbill<->Registrar
     * @param  [string] $id [Domain ID]
     * @return json
     */
    public function domainSynchronize($id)
    {
        $data['call'] = "domainSynchronize";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Request domain EPP (Transfer) Code
     * @param  [string] $id [Domain ID]
     * @return json
     */
    public function domainEPP($id)
    {
        $data['call'] = "domainEPP";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Check domain availability
     * @param  [string] $domain [Domain name to availability check, ie. google.com]
     * @return json
     */
    public function domainCheck($domain)
    {
        $data['call'] = "domainCheck";
        $data['domain'] = $domain;
        return $this->hbQuery($data);
    }

    // ******** Transactions ***********

    /**
     * Get list of transactions.
     * @return json
     */
    public function getTransactions()
    {
        $data['call'] = "getTransactions";
        return $this->hbQuery($data);
    }

     /**
     * Return transaction details
     * @param [string] $id [Transaction ID]
     * @return json
     */
    public function getTransactionDetails($id)
    {
        $data['call'] = "getTransactionDetails";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    // ******** Support/Tickets ***********

    /**
     * Get list of tickets. Return list of tickets from departments administrator is assigned to
     * @param  string $list [Status of tickets to list: all, open, client-reply, in-progress, answered, closed]
     * @return json
     */
    public function getTickets($list="all")
    {
        $data['call'] = "getTickets";
        $data['list'] = $list;
        return $this->hbQuery($data);
    }

    /**
     * View ticket details by its number.
     * @param  [string] $id [Ticket number]
     * @return json
     */
    public function getTicketDetails($id)
    {
        $data['call'] = "getTicketDetails";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Get list of admin favourite predefined replies
     * @return json
     */
    public function getPopularPredefinedReplies()
    {
        $data['call'] = "getPopularPredefinedReplies";
        return $this->hbQuery($data);
    }

    /**
     * Get predefined reply text.
     * @param  [string] $id [Predefined reply ID]
     * @return json
     */
    public function getPredefinedReply($id)
    {
        $data['call'] = "getPredefinedreply";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * If category id set to 0 - return all categories, otherwise return replies from this category.
     * @param  integer $cid [Predefined reply category id or 0]
     * @return json
     */
    public function getPredefinedReplies($cid=0)
    {
        $data['call'] = "getPredefinedReplies";
        $data['cid'] = $cid;
        return $this->hbQuery($data);
    }

    /**
     * Get list of ticket departments.
     * @return json
     */
    public function getTicketDepts()
    {
        $data['call'] = "getTicketDepts";
        return $this->hbQuery($data);
    }

    /**
     * Change ticket status.
     * @param [string] $id     [Ticket number]
     * @param [string] $status [New ticket status: Open, Closed, Client-Reply, In-Progress, Answered]
     * @return json
     */
    public function setTicketStatus($id, $status)
    {
        $data['call'] = "setTicketStatus";
        $data['id'] = $id;
        $data['status'] = $status;
        return $this->hbQuery($data);
    }

    /**
     * Change ticket priority.
     * @param [string] $id       [Ticket number]
     * @param [string] $priority [New ticket priority: High, Low, Medium]
     * @return json
     */
    public function setTicketPriority($id, $priority)
    {
        $data['call'] = "setTicketPriority";
        $data['id'] = $id;
        $data['priority'] = $priority;
        return $this->hbQuery($data);
    }

    /**
     * Delete ticket by its number.
     * @param  [string] $id [Ticket number]
     * @return json
     */
    public function deleteTicket($id)
    {
        $data['call'] = "deleteTicket";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Add reply to ticket as administrator
     * @param  [string] $id [Ticket number]
     * @param  [string] $body [Reply message]
     * @return json
     */
    public function addTicketReply($id, $body)
    {
        $data['call'] = "addTicketReply";
        $data['id'] = $id;
        $data['body'] = $body;
        return $this->hbQuery($data);
    }

    /**
     * Sets new ticket notes
     * @param  [string] $id [Ticket number]
     * @param  [string] $notes [New ticket notes]
     * @return json
     */
    public function addTicketNotes($id, $notes)
    {
        $data['call'] = "addTicketNotes";
        $data['id'] = $id;
        $data['notes'] = $notes;
        return $this->hbQuery($data);
    }

    /**
     * Creates new ticket department
     * @param [string] $email    [Department email]
     * @param [string] $name     [Department name]
     * @param [string] $method   [Ticket import method, POP or PIPE]
     * @param [string] $host     [Email host for POP import method]
     * @param [string] $login    [SMTP username for POP import method]
     * @param [string] $password [SMTP password for POP import]
     * @param [string] $port     [SMTP port for POP import]
     * @return json
     */
    public function addTicketDept($email, $name, $method, $host, $login, $password, $port)
    {
        $data['call'] = "addTicketDept";
        $data['email'] = $email;
        $data['name'] = $name;
        $data['method'] = $method;
        $data['host'] = $host;
        $data['login'] = $login;
        $data['password'] = $password;
        $data['port'] = $port;
        return $this->hbQuery($data);
    }

    /**
     * Opens new support ticket
     * @param [string] $name    [Name of client to open ticket for]
     * @param [string] $subject [Ticket subject]
     * @param [string] $body    [Ticket message]
     * @param [string] $email   [Email address of person opening ticket]
     * @return json
     */
    public function addTicket($name, $subject, $body, $email)
    {
        $data['call'] = "addTicket";
        $data['name'] = $name;
        $data['subject'] = $subject;
        $data['body'] = $body;
        $data['email'] = $email;
        return $this->hbQuery($data);
    }

    // ******** Misc ***********

    /**
     * Get list of news created in system
     * @return json
     */
    public function getNews()
    {
        $data['call'] = "getNews";
        return $this->hbQuery($data);
    }

    /**
     * View news item by its ID
     * @param  [string] $id [News item id]
     * @return json
     */
    public function getNewsItem($id)
    {
        $data['call'] = "getNewsItem";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Get list of main knowledgebase categories
     * @return json
     */
    public function getKBCategories()
    {
        $data['call'] = "getKBCategories";
        return $this->hbQuery($data);
    }

    /**
     * Get knowledgebase article by its ID.
     * @param  [string] $id [Article ID]
     * @return json
     */
    public function getKBArticle($id)
    {
        $data['call'] = "getKBArticle";
        return $this->hbQuery($data);
    }

    /**
     * Get list of active payment gateways
     * @return json
     */
    public function getPaymentModules()
    {
        $data['call'] = "getPaymentModules";
        return $this->hbQuery($data);
    }

    /**
     * Send message from HostBill
     * @param  [string]  $subject [Message subject]
     * @param  [string]  $body    [Message body]
     * @param  [string]  $to      [Recipient address, use ; to separate multiple recipients]
     * @param  integer $html    [Set to 1 to send message as HTML]
     * @return json
     */
    public function sendMessage($subject, $body, $to, $html=0)
    {
        $data['call'] = "sendMessage";
        $data['subject'] = $subject;
        $data['body'] = $body;
        $data['to'] = $to;
        $data['html'] = $html;
        return $this->hbQuery($data);
    }

    /**
     * Add new translations to your localizations
     * @param [string] $target [To which group of languages you want to add nw lines, admin or user]
     * @param [string] $lines  [Two dimensional associative array where first dimension key describes sections and second dimension key describes keywords]
     * @return json
     */
    public function addLanguageLines($target, Array $lines)
    {
        $data['call'] = "addLanguageLines";
        $data['target'] = $target;
        $data['lines'] = $lines;
        return $this->hbQuery($data);
    }

    /**
     * Get list of apps/app groups defined in system (From Settings->Apps)
     * @return json
     */
    public function getAppGroups()
    {
        $data['call'] = "getAppGroups";
        return $this->hbQuery($data);
    }

    /**
     * Get list of servers defined under App (i.e.: Settings->Apps->cPanel)
     * @param  [string] $group [Apps group ID]
     * @return json
     */
    public function getAppServers($group)
    {
        $data['call'] = "getAppServers";
        $data['group'] = $group;
        return $this->hbQuery($data);
    }

    /**
     * Get server details. Warning.: This method returns decrypted server password.
     * @param  [string] $id [Server ID]
     * @return json
     */
    public function getServerDetails($id)
    {
        $data['call'] = "getServerDetails";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    // ******** Estimates ***********

    /**
     * Get list of estimates
     * @return json
     */
    public function getEstimates()
    {
        $data['call'] = "getEstimates";
        return $this->hbQuery($data);
    }

    /**
     * Get estimate details
     * @param  [string] $id [Estimate ID]
     * @return json
     */
    public function getEstimateDetails($id)
    {
        $data['call'] = "getEstimateDetails";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Change estimate status.
     * @param [type] $id     [Estimate ID]
     * @param [type] $status [New estimate status: Draft, Sent, Accepted, Invoiced, Dead]
     * @return json
     */
    public function setEstimateStatus($id, $status)
    {
        $data['call'] = "setEstimateStatus";
        $data['id'] = $id;
        $data['status'] = $status;
        return $this->hbQuery($data);
    }

    /**
     * Edit estimate details
     * @param  [string] $id      [Estimate ID]
     * @param  array  $options [date_created, date_expires]
     * @return json
     */
    public function editEstimateDetails($id, Array $options = array())
    {
        foreach($options as $key=>$value)
            $data[$key] = $value;

        $data['call'] = "editEstimateDetails";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Delete Estimate
     * @param  [string] $id [Estimate ID]
     * @return json
     */
    public function deleteEstimate($id)
    {
        $data['call'] = "deleteEstimate";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Send estimate to customer and change its status to SEND
     * @param  [string] $id [Estimate ID]
     * @return json
     */
    public function sendEstimate($id)
    {
        $data['call'] = "sendEstimate";
        $data['id'] = $id;
        return $this->hbQuery($data);
    }

    /**
     * Creates new estimate
     * @param [string] $clienit_id [Client id to create estimate for]
     * @return json
     */
    public function addEstimate($clienit_id)
    {
        $data['call'] = "addEstimate";
        $data['client_id'] = $client_id;
        return $this->hbQuery($data);
    }

    // ******** Settings ***********

    /**
     * Get list of currencies in HostBill
     * @return json
     */
    public function getCurrencies()
    {
        $data['call'] = "getCurrencies";
        return $this->hbQuery($data);
    }
}
