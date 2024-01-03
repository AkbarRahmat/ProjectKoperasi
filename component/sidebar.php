<style>
    /* Gaya khusus untuk desktop */
    @media (min-width: 768px) {
        #mobile-template {
            display: none;
            /* Sembunyikan template untuk smartphone pada tampilan desktop */
        }
    }

    /* Gaya khusus untuk smartphone */
    @media (max-width: 767px) {
        #desktop-template {
            display: none;
            /* Sembunyikan template untuk desktop pada tampilan smartphone */
        }
    }
</style>
<?php
class Sidebar
{
    static $menuList = [];
    static public function selection($select)
    {
        $username = "";
        $role = "";
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
        }
        if (isset($_SESSION['role'])) {
            $role = $_SESSION['role'];
        }

        // Menu
        if ($role == "user") {
            self::$menuList = [
                "dashboard" => ["Dashboard", "ri-dashboard-line"],
                "simpanan" => ["Simpanan", "ri-safe-2-line"],
                "pinjaman" => ["Pinjaman", "ri-money-dollar-circle-line"],
                "pembayaran_pinjaman" => ["Pembayaran pinjaman", "ri-cash-line"]
            ];
        } elseif ($role == "admin") {
            self::$menuList = [
                "dashboard" => ["Dashboard", "ri-dashboard-line"],
                "simpanan" => ["Simpanan", "ri-safe-2-line"],
                "pinjaman" => ["Pinjaman", "ri-money-dollar-circle-line"],
                "anggota" => ["Kelola data Anggota", "ri-database-line"]
            ];
        }

        return sidebarElement($select, self::$menuList, $username);
    }
}
?>
    <?php function sidebarElement($select, $data, $username)
    { ?>
    <div id="desktop-template">
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px; height: 100vh;">
            <span class="fs-4">Wiatakarya Sejahtera</span>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <?php foreach ($data as $key => $value): ?>
                    <li class="nav-item">
                        <a href="./<?= $key ?>.php" class="nav-link 
            <?= ($key == $select) ? 'active' : 'link-dark' ?>" aria-current="page">
                            <i class="<?= $value[1] ?>"></i>
                            <?= $value[0] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle "
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-user-3-fill "></i>
                    <strong>
                        <?= $username ?>
                    </strong>
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                    <li><a class="dropdown-item" href="./profile.php">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="./login.php">Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="mobile-template">
        <div class="d-flex flex-column flex-shrink-0 bg-light" style="width: 4.5rem;">
            <a href="/" class="d-block p-3 link-dark text-decoration-none" title="Icon-only" data-bs-toggle="tooltip"
                data-bs-placement="right">
                <svg class="bi" width="40" height="32">
                    <use xlink:href="#bootstrap" />
                </svg>
                <span class="fs-2">Icon-only</span>
            </a>
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <?php foreach ($data as $key => $value): ?>
                    <li class="nav-item">
                        <a href="./<?= $key ?>.php" class="nav-link 
            <?= ($key == $select) ? 'active' : 'link-dark' ?>" aria-current="page">
                            <i class="<?= $value[1] ?>"></i>
                            <?= $value[0] ?>
                        </a>
                    </li>
                <?php endforeach; ?>

        </div>
    </div>
<?php } ?>