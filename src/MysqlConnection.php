<?php

namespace Coopxl\LaravelMysqlSpatial;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Types\Type as DoctrineType;
use Coopxl\LaravelMysqlSpatial\Schema\Builder;
use Coopxl\LaravelMysqlSpatial\Schema\Grammars\MySqlGrammar;
use Illuminate\Database\MySqlConnection as IlluminateMySqlConnection;
 
class MysqlConnection extends IlluminateMySqlConnection
{
    public function __construct($pdo, $database = '', $tablePrefix = '', array $config = [])
    {
        parent::__construct($pdo, $database, $tablePrefix, $config);

        if (php_sapi_name() !== 'cli' && class_exists(DoctrineType::class)) {
            try {
                // ✅ إنشاء اتصال Doctrine متوافق مع DBAL 4
                $doctrineConnection = DriverManager::getConnection([
                    'dbname'   => $this->getDatabaseName(),
                    'user'     => $this->getConfig('username'),
                    'password' => $this->getConfig('password'),
                    'host'     => $this->getConfig('host'),
                    'driver'   => 'pdo_mysql',
                    'charset'  => $this->getConfig('charset', 'utf8mb4'),
                    'port'     => $this->getConfig('port', 3306),
                ]);

                $schemaManager = $doctrineConnection->createSchemaManager();
                $dbPlatform = $schemaManager->getDatabasePlatform();

                // 🧭 تسجيل أنواع الحقول الجغرافية كـ string حتى لا تحدث مشاكل
                $geometries = [
                    'geometry', 'point', 'linestring', 'polygon',
                    'multipoint', 'multilinestring', 'multipolygon',
                    'geometrycollection', 'geomcollection',
                ];

                foreach ($geometries as $type) {
                    $dbPlatform->registerDoctrineTypeMapping($type, 'string');
                }
            } catch (\Throwable $e) {
                report($e); // سجل الخطأ بدلاً من إيقاف التنفيذ
            }
        }
    }

    /**
     * ✅ استخدام grammar مخصص مع prefix
     */
    protected function getDefaultSchemaGrammar()
    {
        // return (new MySqlGrammar())->withTablePrefix($this->getTablePrefix());
        return (new MySqlGrammar($this))->withTablePrefix($this->getTablePrefix());
    }

    /**
     * ✅ تهيئة الـ schema builder مع grammar الحالي
     */
    public function getSchemaBuilder()
    {
        if (is_null($this->schemaGrammar)) {
            $this->useDefaultSchemaGrammar();
        }

        return new Builder($this);
    }
}
