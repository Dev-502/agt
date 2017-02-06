<?php

namespace AnimeGT\AnimeGT\Map;

use AnimeGT\AnimeGT\Videos;
use AnimeGT\AnimeGT\VideosQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'videos' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class VideosTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'AnimeGT.AnimeGT.Map.VideosTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'videos';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\AnimeGT\\AnimeGT\\Videos';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'AnimeGT.AnimeGT.Videos';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id field
     */
    const COL_ID = 'videos.id';

    /**
     * the column name for the eid field
     */
    const COL_EID = 'videos.eid';

    /**
     * the column name for the url field
     */
    const COL_URL = 'videos.url';

    /**
     * the column name for the episode field
     */
    const COL_EPISODE = 'videos.episode';

    /**
     * the column name for the 360 field
     */
    const COL_360 = 'videos.360';

    /**
     * the column name for the 480 field
     */
    const COL_480 = 'videos.480';

    /**
     * the column name for the 720 field
     */
    const COL_720 = 'videos.720';

    /**
     * the column name for the 1080 field
     */
    const COL_1080 = 'videos.1080';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Eid', 'Url', 'Episode', '360', '480', '720', '1080', ),
        self::TYPE_CAMELNAME     => array('id', 'eid', 'url', 'episode', '360', '480', '720', '1080', ),
        self::TYPE_COLNAME       => array(VideosTableMap::COL_ID, VideosTableMap::COL_EID, VideosTableMap::COL_URL, VideosTableMap::COL_EPISODE, VideosTableMap::COL_360, VideosTableMap::COL_480, VideosTableMap::COL_720, VideosTableMap::COL_1080, ),
        self::TYPE_FIELDNAME     => array('id', 'eid', 'url', 'episode', '360', '480', '720', '1080', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Eid' => 1, 'Url' => 2, 'Episode' => 3, '360' => 4, '480' => 5, '720' => 6, '1080' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'eid' => 1, 'url' => 2, 'episode' => 3, '360' => 4, '480' => 5, '720' => 6, '1080' => 7, ),
        self::TYPE_COLNAME       => array(VideosTableMap::COL_ID => 0, VideosTableMap::COL_EID => 1, VideosTableMap::COL_URL => 2, VideosTableMap::COL_EPISODE => 3, VideosTableMap::COL_360 => 4, VideosTableMap::COL_480 => 5, VideosTableMap::COL_720 => 6, VideosTableMap::COL_1080 => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'eid' => 1, 'url' => 2, 'episode' => 3, '360' => 4, '480' => 5, '720' => 6, '1080' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('videos');
        $this->setPhpName('Videos');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\AnimeGT\\AnimeGT\\Videos');
        $this->setPackage('AnimeGT.AnimeGT');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('eid', 'Eid', 'VARCHAR', true, 50, null);
        $this->addColumn('url', 'Url', 'VARCHAR', true, 200, null);
        $this->addColumn('episode', 'Episode', 'VARCHAR', true, 100, null);
        $this->addColumn('360', '360', 'LONGVARCHAR', true, null, null);
        $this->addColumn('480', '480', 'LONGVARCHAR', true, null, null);
        $this->addColumn('720', '720', 'LONGVARCHAR', true, null, null);
        $this->addColumn('1080', '1080', 'LONGVARCHAR', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? VideosTableMap::CLASS_DEFAULT : VideosTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Videos object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = VideosTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = VideosTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + VideosTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = VideosTableMap::OM_CLASS;
            /** @var Videos $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            VideosTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = VideosTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = VideosTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Videos $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                VideosTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(VideosTableMap::COL_ID);
            $criteria->addSelectColumn(VideosTableMap::COL_EID);
            $criteria->addSelectColumn(VideosTableMap::COL_URL);
            $criteria->addSelectColumn(VideosTableMap::COL_EPISODE);
            $criteria->addSelectColumn(VideosTableMap::COL_360);
            $criteria->addSelectColumn(VideosTableMap::COL_480);
            $criteria->addSelectColumn(VideosTableMap::COL_720);
            $criteria->addSelectColumn(VideosTableMap::COL_1080);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.eid');
            $criteria->addSelectColumn($alias . '.url');
            $criteria->addSelectColumn($alias . '.episode');
            $criteria->addSelectColumn($alias . '.360');
            $criteria->addSelectColumn($alias . '.480');
            $criteria->addSelectColumn($alias . '.720');
            $criteria->addSelectColumn($alias . '.1080');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(VideosTableMap::DATABASE_NAME)->getTable(VideosTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(VideosTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(VideosTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new VideosTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Videos or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Videos object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VideosTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \AnimeGT\AnimeGT\Videos) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(VideosTableMap::DATABASE_NAME);
            $criteria->add(VideosTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = VideosQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            VideosTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                VideosTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the videos table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return VideosQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Videos or Criteria object.
     *
     * @param mixed               $criteria Criteria or Videos object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VideosTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Videos object
        }

        if ($criteria->containsKey(VideosTableMap::COL_ID) && $criteria->keyContainsValue(VideosTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.VideosTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = VideosQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // VideosTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
VideosTableMap::buildTableMap();