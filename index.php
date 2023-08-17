<?php
require_once("templates/Header.php")
?>

<main>
      <div class="container-fluid main-header">
        <div class="container p-5">
          <div class="main-header-content">
            <h2>O MELHOR<br>CUIDADO PARA<br>SEU MELHOR<br>AMIGO</h2>
            <p>Está esperando o que para fazer seu pet mais feliz? Aqui você encontra o cuidado que seu pet merece. Banho, tosa, rações e acessórios.</p>
            <button class="btn pt-2 pb-2 ps-4 pe-4">Agendar serviço</button>
          </div>
        </div>
      </div>
      <div class="container-fluid main-nossos-servicos">
        <h2 class="text-center pt-4">NOSSOS SERVIÇOS</h2>
        <div class="container">
          <div class="row">
           <div class="col-lg-12">
              <div class="row nossos-servicos-line-1">
                <div class="col-lg-6">
                  <div class="row d-flex justify-content-center nossos-servicos-card">
                    <div class="col-6 w-25 text-center">
                      <div class="img-nossos-servicos">
                        <img src="img/cachorrotosa.jpg" alt="cachorrotosa">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <h4>Tosa</h4>
                      <p>A tosa é um procedimento de corte do pelo de um animal de estimação.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="row d-flex justify-content-center nossos-servicos-card">
                    <div class="col-lg-6 w-25 text-center">
                      <div class="img-nossos-servicos">
                        <img src="img/cachorrovet.jpg" alt="cachorrotosa">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <h4>Veterinário</h4>
                      <p>A função do médico veterinário é cuidar da saúde e bem-estar dos animais.</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row nossos-servicos-line-2">
                <div class="col-lg-6">
                  <div class="row d-flex justify-content-center nossos-servicos-card">
                    <div class="col-lg-6 w-25 text-center">
                      <div class="img-nossos-servicos">
                        <img src="img/cachorrobanho.jpg" alt="cachorrotosa">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <h4>Banho</h4>
                      <p>O banho em PET é uma atividade essencial para manter a higiene e o bem-estar do animal de estimação.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="row d-flex justify-content-center nossos-servicos-card">
                    <div class="col-lg-6 w-25 text-center">
                      <div class="img-nossos-servicos">
                        <img src="img/cachorroacessorios.jpg" alt="cachorrotosa">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <h4>Acessórios</h4>
                      <p>Os acessórios para animais de estimação são itens projetados para melhorar o conforto, bem-estar, segurança e estilo dos animais de estimação.</p>
                    </div>
                  </div>
                </div>
              </div>
           </div>
          </div>
        </div>
      </div>

      <div class="container-fluid agendamento">
        <div class="row d-flex justify-content-center align-items-center">
          <div class="col-lg-6 p-0 m-0">
            <div class="agendamento-img"></div>
          </div>
          <div class="col-lg-6 text-center p-5">
            <h4>Para realizar um agendamento é necessário ter um pet cadastrado. <br> <span>Cadastre seu pet agora mesmo!</span></h4>
            <button class="btn pt-1 pb-1 ps-4 pe-4 mt-4">Cadastrar</button>
            <h4 class="mt-5 mb-5">ou</h4>
            <h4>Faça um agendamento para um pet<br><span>já cadastrado!</span></h4>
            <button class="btn pt-1 pb-1 ps-4 pe-4  mt-4">Agendar</button>
          </div>
        </div>
      </div>
    </main>

<?php
  require_once("templates/Footer.php")
?>
