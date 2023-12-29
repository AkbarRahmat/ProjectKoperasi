
<?php 
class Sidebar {
    static $menuList = [];
    static public function selection($select) {
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
            self::$menuList =  [
            "dashboard" => "Dashboard",
            "simpanan" => "Simpanan",
            "pinjaman" => "Pinjaman",
            "pembayaran_pinjaman" => "Pembayaran pinjaman"
            ];
        } elseif ($role == "admin" ) {
            self::$menuList =  [
                "dashboard" => "Dashboard",
                "simpanan" => "Simpanan",
                "pinjaman" => "Pinjaman",
                "anggota" => "Kelola data Anggota"
                ];
        }

        return sidebarElement($select, self::$menuList, $username);
    }
}
?>
<?php function sidebarElement($select, $data, $username) {?>
<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px; height: 100vh;">  
        <span class="fs-4">Wiatakarya Sejahtera</span>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
    <?php foreach ($data as $key => $value) : ?>
        <li class="nav-item">
            <a href="./<?= $key ?>.php" class="nav-link 
            <?= ($key == $select) ? 'active' : 'link-dark' ?>" aria-current="page">
                <svg class="bi me-2" width="16" height="16">
                </svg>
                <?= $value ?>
            </a>
        </li>
    <?php endforeach; ?>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="ri-user-3-fill"></i>
            <strong><?= $username ?></strong>
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
<?php }  ?>
