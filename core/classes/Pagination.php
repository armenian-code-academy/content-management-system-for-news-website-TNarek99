<?php

class Pagination
{
    const ITEMS_PER_PAGE = 5;

    /**
     * @var int
     */
    protected $itemsCount;

    /**
     * @var int
     */
    protected $currentPage;

    /**
     * @var string
     */
    protected $baseURL;

    /**
     * Pagination constructor.
     * @param $itemsCount
     * @param $baseURL
     */
    public function __construct($itemsCount, $baseURL)
    {
        $currentPage = 1;
        if (isset($_GET['page'])) {
            $currentPage = $_GET['page'];
        }

        $this->currentPage = $currentPage;

        $this->itemsCount = $itemsCount;
        $this->baseURL = $baseURL;
    }

    public function getOffset()
    {
        $offset = ($this->currentPage - 1) * self::ITEMS_PER_PAGE;

        return $offset;
    }

    public function draw()
    {
        echo '
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
        ';

        for ($page = 1; $page <= $this->getPagesCount(); $page++) {

            if ($page == $this->currentPage) {
                echo '<li class="active"><a href="' . NEWS_ADMIN_ROOT_URL . '?' . $this->baseURL . '&page=' . $page . '">' . $page . '</a></li>';
            } else {
                echo '<li><a href="' . NEWS_ADMIN_ROOT_URL . '?' . $this->baseURL . '&page=' . $page . '">' . $page . '</a></li>';
            }
        }

        echo '
                <li>
                    <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
        ';
    }

    private function getPagesCount()
    {
        return ceil($this->itemsCount / self::ITEMS_PER_PAGE);
    }
}