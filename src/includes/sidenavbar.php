<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar navbar-dark">
        <a href="" class="navbar-brand mx-4 mb-3">
            <h1 class="text-primary" style="font-size: 15px;"><i class="fas fa-terminal me-3"></i>Processo seletivo</h1>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <i class="fa fa-user light me-2" style="font-size: 25px; color: white;"></i>
            </div>
            <div class="ms-3">
                <h6 class="name-user mb-0" style="color: white;"></h6>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="home" class="nav-item nav-link indexmaster"><i class="fas fa-sort-numeric-up-alt me-2"></i>Número romano</a>
            <a href="treeMap" class="nav-item nav-link treeMap"><i class="fab fa-hive me-2"></i>Three map</a>
        </div>
    </nav>
</div>
<!-- Sidebar End -->

<script>
    let currentPath = window.location.pathname.split('/').pop();

    // Mapeia os itens de navegação e adiciona a classe "active" ao item correspondente
    const navigationItems = document.querySelectorAll('.nav-item');
    navigationItems.forEach(item => {
        const linkPath = item.getAttribute('href').split('/').pop();
        if (linkPath === currentPath) {
            item.classList.add('active');
        }
    });
</script>