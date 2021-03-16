<?php

    /**
     * @var EntityManagerInterface
     */
    class CreateService
    {
        private $conn;
        private $entityIds = [];
        private $customerIds = [];


        public function __construct()
        {
            $this->conn = new PDO("mysql:host=localhost;dbname=s-report;port=3306;charset=utf8", "root");
        }

        public function execute()
        {
            $daysOnYear = 365;
            $loadYear = 3;
            $currentDate = new DateTime();
            $this->loadEntityIds();
            $this->loadCustomerIds();

            $totalCustomer = count($this->customerIds);

            foreach ($this->customerIds as $idCustomer) {
                $date = new DateTime(sprintf('first day of January %s', date('Y')));
                $date->modify(sprintf('- %s years', $loadYear));

                while ($date < $currentDate) {
                    $this->conn->query("INSERT INTO service (client_id,created_at,updated_at,date) VALUES ('$idCustomer',$date->format('Y-m-d 17:00:00'),'$date->format('Y-m-d 17:00:00')','$date->format('Y-m-d H:i:s')')");
                    $serviceID = $this->conn->lastInsertId();
                    $entityUsed = [];
                    for ($i = 0; $i < random_int(1, count($this->entityIds)); $i++) {
                        $entityOnUse = $this->entityIds[rand(0, count($this->entityIds) - 1)];
                        if (!array_key_exists($entityOnUse, $entityUsed)) {
                            $this->conn->query("INSERT INTO detail_service (service_id,value,entity_id) VALUES ('$serviceID','random_int(1, 50)','$entityOnUse')");

                            $entityUsed[$entityOnUse] = $entityOnUse;
                        }
                    }

                    if ($date->format('N') == 5) {
                        $date->modify('+ 3 day');
                    } else {
                        $date->modify('+ 1 day');
                    }
                }
            }
        }

        function loadEntityIds()
        {
            $ids = $this->conn->query('SELECT id FROM entity');
            foreach ($ids as $id) {
                $this->entityIds[] = $id['id'];
            }
        }

        function loadCustomerIds()
        {
            $ids = $this->conn->query('SELECT id FROM client');
            foreach ($ids as $id) {
                $this->customerIds[$id['id']] = $id['id'];
            }
        }
    }

    $createService = new CreateService();
    $createService->execute();