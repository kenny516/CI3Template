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
            <a class="nav-link collapsed" href="<?= site_url('BackOffice/dashboard'); ?>">
                <i class="bi bi-grid"></i>
                <span>Tableau de bord</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= site_url('BackOffice/appointment'); ?>">
                <i class="bi bi-calendar-week"></i>
                <span>Rendez-vous</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= site_url('BackOffice/quotation/list'); ?>">
                <i class="bi bi-receipt"></i>
                <span>Liste des devis</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= site_url('BackOffice/slot'); ?>">
                <i class="ri-car-fill"></i>
                <span>Utilisation des slots</span>
            <a class="nav-link collapsed text-success" href="<?= site_url('Back_office_csv'); ?>">
                <i class="ri-pencil-line text-success"></i>
                <span>Import csv</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed text-danger" href="<?= site_url('BackOffice/reinitialize'); ?>">
                <i class="ri-delete-bin-2-line text-danger"></i>
                <span>Réinitialiser les données</span>
            </a>
        </li>
    </ul>
</aside>
