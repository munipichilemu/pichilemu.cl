<div id="municipal">
  <h2 class="sr-only">Institucionalidad municipal</h2>

  {{-- TODO: Sitio de Turismo --}}
  <a href="https://www.instagram.com/pichilemu.turismo/" id="turismo">
    <img alt="" class="backdrop" src="@asset('images/laguna-cahuil.jpeg')">
    <div class="info">
      <img alt="" src="@asset('images/logos/turismo-pluma.svg')">
      <h3>Departamento de Turismo</h3>
      <p>Conozca las atracciones, lugares, actividades y servicios turísticos disponibles en la comuna.</p>
    </div>
  </a>

  {{-- TODO: Sitio de Cultura --}}
  <a href="https://www.instagram.com/centroculturalagustinross/" id="cultura">
    <img alt="" class="backdrop" src="@asset('images/casino.jpeg')">
    <div class="info">
      <img alt="" src="@asset('images/logos/cultura-pluma.svg')">
      <h3>Oficina de la Cultura</h3>
      <p>Entérese de las diversas actividades, talleres y exposiciones culturales del Centro Cultural Agustín Ross.</p>
    </div>
  </a>

  <section id="concejo">
    <img alt="Sesiones del Concejo Municipal" class="backdrop" src="@asset('images/podio.jpeg')">
    <div class="info">
      <h3>
        <img src="@asset('images/logos/concejo.svg')" alt="Honorable Concejo Municipal">
      </h3>
      <p>Participe en la toma de decisiones y conozca el trabajo de sus representantes en el gobierno local.</p>
      <ul>
        <li>
          <a href="{{ site_url('/municipalidad/concejo') }}">
            <x-fas-people-line class="fa-fw"/>
            Miembros del Concejo
          </a>
        </li>
        <li>
          <a href="https://www.youtube.com/@ConcejosMunicipalidadPichilemu">
            <x-fab-youtube class="fa-fw"/>
            Sesiones del Concejo
          </a>
        </li>
      </ul>
    </div>
  </section>

  <section id="medioambiente">
    <div class="info">
      <img alt="" src="@asset('images/logos/medioambiente-pluma.svg')">
      <h3>Dirección de Medioambiente</h3>
      <p>Construyamos una comuna más sustentable y en armonía con la naturaleza.</p>
    </div>

    <ul class="links">
      <li>
        <a href="{{ site_url('/ambiental/denuncias') }}">
          <x-fas-bullhorn class="fa-fw"/>
          Denuncias medioambientales
        </a>
      </li>
      <li>
        <a href="{{ site_url('/ambiental/puntos-limpios') }}">
          <x-fas-map-location-dot class="fa-fw"/>
          Contenedores aseo y reciclaje
        </a>
      </li>
      <li>
        <a href="{{ site_url('/ambiental/normativa') }}">
          <x-fas-gavel class="fa-fw"/>
          Instrumentos normativos
        </a>
      </li>
      {{-- TODO: Ambiental: Ordenanzas e iniciativas --}}
      {{--<li>
        <a href="/ambiental/iniciativas">
          <x-fas-leaf class="fa-fw"/>
          Iniciativas medioambientales
        </a>
      </li>--}}
      <li>
        <a href="https://www.instagram.com/medioambientepichilemu/">
          <x-fab-instagram class="fa-fw"/>
          Actividades e iniciativas
        </a>
      </li>
    </ul>
  </section>

  <section id="scam">
    <h3 class="sr-only">Sistema de Certificación Ambiental Municipal</h3>
    <x-fak-scam-2 class="acreditacion"/>

    <ul class="links">
      <li>
        <a href="{{ site_url('/ambiental/scam/acerca') }}">
          <x-fas-circle-question class="fa-fw"/>
          Qué es el SCAM
        </a>
      </li>
      <li>
        <a href="{{ site_url('/ambiental/scam/objetivos') }}">
          <x-fas-clipboard-list-check class="fa-fw"/>
          Objetivos locales
        </a>
      </li>
      <li>
        <a href="{{ site_url('/ambiental/normativa') }}">
          <x-fas-gavel class="fa-fw"/>
          Normativas
        </a>
      </li>
    </ul>
  </section>
</div>
