<?php

namespace Fluent\Laraci\Collectors;

use CodeIgniter\Debug\Toolbar\Collectors\BaseCollector;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * EloquentCollector
 */
class EloquentCollector extends BaseCollector
{
    /**
     * Whether this collector needs to display
     * content in a tab or not.
     *
     * @var bool
     */
    protected $hasTabContent = true;

    /**
     * Array of database connections.
     */
    protected $connections;

    /**
     * The 'title' of this Collector.
     * Used to name things in the toolbar HTML.
     *
     * @var string
     */
    protected $title = 'Eloquent';

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->getConnections();
    }

    /**
     * Returns any information that should be shown next to the title.
     */
    public function getTitleDetails(): string
    {
        return $this->connections::class;
    }

    /**
     * Returns the data of this collector to be formatted in the toolbar
     */
    public function display(): string
    {
        $config = config('Toolbar');

        // Provide default in case it's not set
        $max = $config->maxQueries ?: 100;

        $queries = $this->connections->getQueryLog();
        if ($queries) {
            $queryDuplicates = array_count_values(array_column($queries, 'query'));
            $queryDuplicates = array_filter($queryDuplicates, fn ($item) => $item > 1);
            $queryDuplicatesCount = array_sum($queryDuplicates);
            $queryCount = count($queries);
            $unique = $queryCount - $queryDuplicatesCount;
            $queries = array_slice($queries, 0, $max);

            $html = sprintf('<h2>%d statements were executed. %s of which were duplicated. %d unique.</h2>', $queryCount, $queryDuplicatesCount, $unique);
            $html .= '<table><thead>';
            $html .= '<tr>';
            $html .= "<th style='width:60px;'>Time</th>";
            $html .= "<th style='width:360px;'>Query String</th>";
            $html .= '</tr>';
            $html .= '</thead><tbody>';
            foreach ($queries as $value) {
                $html .= '<tr>';
                $html .= sprintf("<td style='width:60px;'>%s ms</td>", $value['time']);
                $html .= sprintf("<td style='width:360px;'><code style='color: #DD4814;'><em>%s</em></code></td>", $value['query']);
                $html .= '</tr>';
            }

            $html .= '</tbody></table>';
        } else {
            $html = '<p>No Queries.</p>';
        }

        return $html;
    }

    /**
     * Gets the "badge" value for the button.
     *
     * @return int|null ID of the current User, or null when not logged in
     */
    public function getBadgeValue(): ?int
    {
        return count($this->connections->getQueryLog());
    }

    /**
     * Display the icon.
     *
     * Icon from https://icons8.com - 1em package
     */
    public function icon(): string
    {
        return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAADMSURBVEhLY6A3YExLSwsA4nIycQDIDIhRWEBqamo/UNF/SjDQjF6ocZgAKPkRiFeEhoYyQ4WIBiA9QAuWAPEHqBAmgLqgHcolGQD1V4DMgHIxwbCxYD+QBqcKINseKo6eWrBioPrtQBq/BcgY5ht0cUIYbBg2AJKkRxCNWkDQgtFUNJwtABr+F6igE8olGQD114HMgHIxAVDyAhA/AlpSA8RYUwoeXAPVex5qHCbIyMgwBCkAuQJIY00huDBUz/mUlBQDqHGjgBjAwAAACexpph6oHSQAAAAASUVORK5CYII=';
    }

    /**
     * Gets the connections from the database config
     */
    private function getConnections()
    {
        $this->connections = (new Capsule)->connection();
    }
}
