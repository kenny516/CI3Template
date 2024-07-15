<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-wrench"></i>
                <span>Services</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= site_url('BackOffice/services/list'); ?>">
                        <i class="bi bi-circle"></i><span>Liste des services fournis</span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('BackOffice/services/form'); ?>">
                        <i class="bi bi-circle"></i><span>Formulaire</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= site_url('BackOffice/appointment'); ?>">
                <i class="bi bi-calendar-week"></i>
                <span>Rendez-vous</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= site_url('BackOffice/devis'); ?>">
                <i class="bi bi-receipt"></i>
                <span>Liste des devis</span>
            </a>
        </li>
    </ul>
</aside>
