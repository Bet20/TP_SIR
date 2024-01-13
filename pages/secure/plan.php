<?php 
$title = " - Plan";
session_start();
include_once __DIR__ . '../../../templates/header.php';
require_once __DIR__ . '../../../infra/repositories/planRepository.php';
include_once __DIR__ . '../../../templates/navbar.php';
$plans = getAllPlans();
?>

<!-- Secção "planos" -->
<div id="planos" class="p-3">
  <div
    class="d-flex flex-column align-items-center justify-content-center p-1 py-3 special-background special-border">
    <h2 class="text-center mb-5 text-white text-shadow">Planos de Subscrição</h2>
    <p class="lead text-center mb-5 text-white">Seleciona o plano que melhor se adeque a si</p>
    <div class="row justify-content-center col-12">
      <?php foreach ($plans as $plan) { ?>
        <div class="col-md-4 col-12 h-100 mb-4 mb-md-0" id="<?='plano' . $plan['id']?>" value="<?= $plan['id']?>">
          <div class="card text-center simple-background special-border">
            <div class="card-body custom">
              <h5 class="py-3 rounded-3 bg-black fg-white card-title"><?= $plan['titulo']?></h5>
              <p class="fs-5"><?= $plan['subtitulo']?></p>
              <ul class="text-start col-9 mx-auto">
              <?php $vantagens = explode(',' ,$plan['vantagens']);
                foreach ($vantagens as $vantagem) { 
                  echo '<li>' . $vantagem . '</li>';
                }
              ?>
              </ul>
              <p class="card-text"><u><b><?= $plan['footerTitulo']?></b></u></p>
              <hr />
              <p class="fs-2 card-text"><strong>Preço:</strong><?= $plan['preco'] . '€'?></p>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>
<?php 
include_once __DIR__ . '../../../templates/footer.php';
?>