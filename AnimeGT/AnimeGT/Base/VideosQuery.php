<?php

namespace AnimeGT\AnimeGT\Base;

use \Exception;
use \PDO;
use AnimeGT\AnimeGT\Videos as ChildVideos;
use AnimeGT\AnimeGT\VideosQuery as ChildVideosQuery;
use AnimeGT\AnimeGT\Map\VideosTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'videos' table.
 *
 *
 *
 * @method     ChildVideosQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildVideosQuery orderByEid($order = Criteria::ASC) Order by the eid column
 * @method     ChildVideosQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     ChildVideosQuery orderByEpisode($order = Criteria::ASC) Order by the episode column
 * @method     ChildVideosQuery orderByQ360($order = Criteria::ASC) Order by the q360 column
 * @method     ChildVideosQuery orderByQ480($order = Criteria::ASC) Order by the q480 column
 * @method     ChildVideosQuery orderByQ720($order = Criteria::ASC) Order by the q720 column
 * @method     ChildVideosQuery orderByQ1080($order = Criteria::ASC) Order by the q1080 column
 *
 * @method     ChildVideosQuery groupById() Group by the id column
 * @method     ChildVideosQuery groupByEid() Group by the eid column
 * @method     ChildVideosQuery groupByUrl() Group by the url column
 * @method     ChildVideosQuery groupByEpisode() Group by the episode column
 * @method     ChildVideosQuery groupByQ360() Group by the q360 column
 * @method     ChildVideosQuery groupByQ480() Group by the q480 column
 * @method     ChildVideosQuery groupByQ720() Group by the q720 column
 * @method     ChildVideosQuery groupByQ1080() Group by the q1080 column
 *
 * @method     ChildVideosQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVideosQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVideosQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVideosQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVideosQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVideosQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVideos findOne(ConnectionInterface $con = null) Return the first ChildVideos matching the query
 * @method     ChildVideos findOneOrCreate(ConnectionInterface $con = null) Return the first ChildVideos matching the query, or a new ChildVideos object populated from the query conditions when no match is found
 *
 * @method     ChildVideos findOneById(int $id) Return the first ChildVideos filtered by the id column
 * @method     ChildVideos findOneByEid(string $eid) Return the first ChildVideos filtered by the eid column
 * @method     ChildVideos findOneByUrl(string $url) Return the first ChildVideos filtered by the url column
 * @method     ChildVideos findOneByEpisode(string $episode) Return the first ChildVideos filtered by the episode column
 * @method     ChildVideos findOneByQ360(string $q360) Return the first ChildVideos filtered by the q360 column
 * @method     ChildVideos findOneByQ480(string $q480) Return the first ChildVideos filtered by the q480 column
 * @method     ChildVideos findOneByQ720(string $q720) Return the first ChildVideos filtered by the q720 column
 * @method     ChildVideos findOneByQ1080(string $q1080) Return the first ChildVideos filtered by the q1080 column *

 * @method     ChildVideos requirePk($key, ConnectionInterface $con = null) Return the ChildVideos by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideos requireOne(ConnectionInterface $con = null) Return the first ChildVideos matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVideos requireOneById(int $id) Return the first ChildVideos filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideos requireOneByEid(string $eid) Return the first ChildVideos filtered by the eid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideos requireOneByUrl(string $url) Return the first ChildVideos filtered by the url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideos requireOneByEpisode(string $episode) Return the first ChildVideos filtered by the episode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideos requireOneByQ360(string $q360) Return the first ChildVideos filtered by the q360 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideos requireOneByQ480(string $q480) Return the first ChildVideos filtered by the q480 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideos requireOneByQ720(string $q720) Return the first ChildVideos filtered by the q720 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVideos requireOneByQ1080(string $q1080) Return the first ChildVideos filtered by the q1080 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVideos[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildVideos objects based on current ModelCriteria
 * @method     ChildVideos[]|ObjectCollection findById(int $id) Return ChildVideos objects filtered by the id column
 * @method     ChildVideos[]|ObjectCollection findByEid(string $eid) Return ChildVideos objects filtered by the eid column
 * @method     ChildVideos[]|ObjectCollection findByUrl(string $url) Return ChildVideos objects filtered by the url column
 * @method     ChildVideos[]|ObjectCollection findByEpisode(string $episode) Return ChildVideos objects filtered by the episode column
 * @method     ChildVideos[]|ObjectCollection findByQ360(string $q360) Return ChildVideos objects filtered by the q360 column
 * @method     ChildVideos[]|ObjectCollection findByQ480(string $q480) Return ChildVideos objects filtered by the q480 column
 * @method     ChildVideos[]|ObjectCollection findByQ720(string $q720) Return ChildVideos objects filtered by the q720 column
 * @method     ChildVideos[]|ObjectCollection findByQ1080(string $q1080) Return ChildVideos objects filtered by the q1080 column
 * @method     ChildVideos[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VideosQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \AnimeGT\AnimeGT\Base\VideosQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\AnimeGT\\AnimeGT\\Videos', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVideosQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVideosQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildVideosQuery) {
            return $criteria;
        }
        $query = new ChildVideosQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildVideos|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VideosTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VideosTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVideos A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, eid, url, episode, q360, q480, q720, q1080 FROM videos WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildVideos $obj */
            $obj = new ChildVideos();
            $obj->hydrate($row);
            VideosTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildVideos|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildVideosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VideosTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildVideosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VideosTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideosQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(VideosTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(VideosTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideosTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the eid column
     *
     * Example usage:
     * <code>
     * $query->filterByEid('fooValue');   // WHERE eid = 'fooValue'
     * $query->filterByEid('%fooValue%', Criteria::LIKE); // WHERE eid LIKE '%fooValue%'
     * </code>
     *
     * @param     string $eid The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideosQuery The current query, for fluid interface
     */
    public function filterByEid($eid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($eid)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideosTableMap::COL_EID, $eid, $comparison);
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%', Criteria::LIKE); // WHERE url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $url The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideosQuery The current query, for fluid interface
     */
    public function filterByUrl($url = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideosTableMap::COL_URL, $url, $comparison);
    }

    /**
     * Filter the query on the episode column
     *
     * Example usage:
     * <code>
     * $query->filterByEpisode('fooValue');   // WHERE episode = 'fooValue'
     * $query->filterByEpisode('%fooValue%', Criteria::LIKE); // WHERE episode LIKE '%fooValue%'
     * </code>
     *
     * @param     string $episode The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideosQuery The current query, for fluid interface
     */
    public function filterByEpisode($episode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($episode)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideosTableMap::COL_EPISODE, $episode, $comparison);
    }

    /**
     * Filter the query on the q360 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ360('fooValue');   // WHERE q360 = 'fooValue'
     * $query->filterByQ360('%fooValue%', Criteria::LIKE); // WHERE q360 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q360 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideosQuery The current query, for fluid interface
     */
    public function filterByQ360($q360 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q360)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideosTableMap::COL_Q360, $q360, $comparison);
    }

    /**
     * Filter the query on the q480 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ480('fooValue');   // WHERE q480 = 'fooValue'
     * $query->filterByQ480('%fooValue%', Criteria::LIKE); // WHERE q480 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q480 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideosQuery The current query, for fluid interface
     */
    public function filterByQ480($q480 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q480)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideosTableMap::COL_Q480, $q480, $comparison);
    }

    /**
     * Filter the query on the q720 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ720('fooValue');   // WHERE q720 = 'fooValue'
     * $query->filterByQ720('%fooValue%', Criteria::LIKE); // WHERE q720 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q720 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideosQuery The current query, for fluid interface
     */
    public function filterByQ720($q720 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q720)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideosTableMap::COL_Q720, $q720, $comparison);
    }

    /**
     * Filter the query on the q1080 column
     *
     * Example usage:
     * <code>
     * $query->filterByQ1080('fooValue');   // WHERE q1080 = 'fooValue'
     * $query->filterByQ1080('%fooValue%', Criteria::LIKE); // WHERE q1080 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $q1080 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideosQuery The current query, for fluid interface
     */
    public function filterByQ1080($q1080 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($q1080)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideosTableMap::COL_Q1080, $q1080, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildVideos $videos Object to remove from the list of results
     *
     * @return $this|ChildVideosQuery The current query, for fluid interface
     */
    public function prune($videos = null)
    {
        if ($videos) {
            $this->addUsingAlias(VideosTableMap::COL_ID, $videos->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the videos table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VideosTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VideosTableMap::clearInstancePool();
            VideosTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VideosTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VideosTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VideosTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VideosTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // VideosQuery
