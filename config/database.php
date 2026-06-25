    <?php
    /**
     * Database Configuration
     * Using PDO for secure database connections
     */
    
   $options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::ATTR_PERSISTENT         => false,
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false, // ✅ bỏ verify cert
    PDO::MYSQL_ATTR_SSL_CA       => '/etc/ssl/certs/ca-certificates.crt', // ✅ cert có sẵn trong image
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci",
];
    
    /**
     * Get PDO Database Connection
     * @return PDO
     */
    function getDBConnection() {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        
        try {
            return new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            error_log("Database Connection Error: " . $e->getMessage());
            throw new Exception("Database connection failed. Please check configuration.");
        }
    }
    
