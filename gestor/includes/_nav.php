<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src='../assets/imgs/logo-responsivo.png' width="130"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li><a target="_blank" class="btnDaNav nav-link" href="../data/excel.php"><i class="bi bi-filetype-csv"></i> Exportar <b><span id='verNum'></span></b></a></li>
                <li><span><a href="sair.php" class="nav-link btnDaNav">Sair <i class="bi bi-box-arrow-right"></i> </a></span></li>
                <li>
                    <span><a href="users.php" class="nav-link btnDaNav"> Pesquise <i class="bi bi-search"></i> </a></span>
                </li>
            </ul>
            <span>
                <b>
                    <?= $nome . ' | (Matrícula: ' . $ra . ') ' ?>
                </b>
            </span>
        </div>
    </div>
</nav>

<!-- <div class="container mt-3">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <ul class="nav nav-pills nav-fill gap-2 p-1 small rounded-5 shadow-sm" id="pillNav2" role="tablist" style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-primary); --bs-nav-pills-link-active-bg: var(--bs-white);">
                <li class="nav-item" role="presentation">
                    <a href="#" class="nav-link active rounded-5" id="home-tab2" data-bs-toggle="tab" role="tab" aria-selected="true">Análise de Alunos</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a target="_blank" href="../data/excel.php" class="nav-link rounded-5" id="profile-tab2" data-bs-toggle="tab" role="tab" aria-selected="false">Exportar <i class="bi bi-filetype-xlsx"></i></a>
                </li>
            </ul>

        </div>
        <div class="col-md-2"></div>

    </div> -->
</div>