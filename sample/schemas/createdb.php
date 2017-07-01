<?php
/**
 * Programmatically bootstrap the database
 *
 * @var \Phalcon\Db\AdapterInterface $connection
 */

use Phalcon\Exception;
use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Config\Adapter\Ini as IniConfig;
use Phalcon\Config;

try {
    $configFile = __DIR__ . '/../app/config/config.ini';
    if (!is_file($configFile)) {
        throw new Exception(
            sprintf('Unable to read config file located at %s.', $configFile)
        );
    }

    $config = new IniConfig($configFile);

    /** @var \Phalcon\Config $config */
    $config = $config->get('database');

    if (!$config instanceof Config) {
        throw new Exception('Unable to read database config.');
    }

    $dbClass = sprintf('\Phalcon\Db\Adapter\Pdo\%s', $config->get('adapter', 'MySql'));

    if (!class_exists($dbClass)) {
        throw new Exception(
            sprintf('PDO adapter "%s" not found.', $dbClass)
        );
    }

    $dbConfig = $config->toArray();
    unset($dbConfig['adapter']);

    $connection = new $dbClass($dbConfig);

    $connection->begin();

    $connection->createTable(
        'companies',
        null,
        [
            'columns' => [
                new Column('id', [
                    'type'          => Column::TYPE_INTEGER,
                    'size'          => 10,
                    'unsigned'      => true,
                    'notNull'       => true,
                    'autoIncrement' => true
                ]),
                new Column('title', [
                    'type'    => Column::TYPE_VARCHAR,
                    'size'    => 70,
                    'notNull' => true
                ]),
                new Column('content', [
                    'type'    => Column::TYPE_VARCHAR,
                    'size'    => 500,
                    'notNull' => true
                ])
            ],
            "indexes" => [
                new Index('PRIMARY', ["id"], 'PRIMARY')
            ]
        ]
    );

    $connection->execute("INSERT INTO `companies` VALUES (1,'Acme','Address'),(2,'Acme Inc','+44 564612345')");

    $connection->createTable(
        'users',
        null,
        [
            'columns' => [
                new Column('id', [
                    'type'          => Column::TYPE_INTEGER,
                    'size'          => 10,
                    'unsigned'      => true,
                    'notNull'       => true,
                    'autoIncrement' => true
                ]),
                new Column('username', [
                    'type'    => Column::TYPE_VARCHAR,
                    'size'    => 32,
                    'notNull' => true
                ]),
                new Column('password', [
                    'type'    => Column::TYPE_CHAR,
                    'size'    => 40,
                    'notNull' => true
                ]),
                new Column('email', [
                    'type'    => Column::TYPE_VARCHAR,
                    'size'    => 70,
                    'notNull' => true
                ]),
                new Column('picture', [
                    'type'    => Column::TYPE_VARCHAR,
                    'size'    => 100,
                    'notNull' => true
                ]),
                new Column('created_at', [
                    'type'    => Column::TYPE_TIMESTAMP,
                    'notNull' => true,
                    'default' => 'CURRENT_TIMESTAMP'
                ]),
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY')
            ]
        ]
    );

    $connection->execute("INSERT INTO users VALUES (1,'demo', 'c0bd96dc7ea4ec56741a4e07f6ce98012814d853','demo@phalconphp.com','2012-04-10 20:53:03')");

    $connection->commit();

} catch (\Exception $e) {

    if ($connection->isUnderTransaction()) {
        $connection->rollback();
    }

    echo $e->getMessage(), PHP_EOL;
    echo $e->getTraceAsString(), PHP_EOL;
}
