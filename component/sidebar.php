
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
        <div class="d-flex flex-column flex-shrink-0 p-0" style="width: 200px; height: 78vh;">
            <br>
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
    <div id="mobile-template">
        <div class="mobile d-flex flex-column-reverse flex-shrink-0 h-auto" style="width: 4 rem;">
            <ul class="menu nav nav-pills nav-flush flex-column mb-auto text-center">
                <?php foreach ($data as $key => $value): ?>
                    <li class="nav-item">
                        <a href="./<?= $key ?>.php" class="nav-link 
            <?= ($key == $select) ? 'active' : 'link-dark' ?>" aria-current="page">
                            <i class="<?= $value[1] ?>"></i>
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
<?php } ?>