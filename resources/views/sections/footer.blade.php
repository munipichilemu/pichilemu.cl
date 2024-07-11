<footer itemscope itemtype="https://schema.org/WPFooter">
  <div>
    <section id="oirs">
      <h2>
        <abbr title="Oficina de Informaciones, Reclamos y Sugerencias">OIRS</abbr>
      </h2>

      <address itemscope itemtype="https://schema.org/GovernmentOffice">
        <ul>
          <li itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
            <span class="staggered">
              <x-far-location-dot aria-label="Dirección"/>
            </span>
            <span itemprop="streetAddress">Ángel Gaete 365</span><br>
            <span itemprop="addressLocality">Pichilemu</span>
          </li>

          <li>
            <span class="staggered">
              <x-far-calendar-range aria-label="Horario de atención"/>
            </span>
            <time content="Mo-Fr 08:00-13:00,14:00-17:20" itemprop="openingHours">
              Lunes a Viernes <br>
              8:00 - 13:00 y 14:00 - 17:20
            </time>
          </li>

          <li>
            <span class="staggered">
              <x-far-phone aria-label="Teléfono"/>
            </span>
            <a href="tel:+56722976530" itemprop="telephone">
              +56 722 976 530
            </a>
          </li>
        </ul>
      </address>
    </section>

    @include('sections.nav.footer-interno')

    @include('sections.nav.footer-externo')

    <section id="seguridad">
      <h2>Seguridad Pública</h2>

      <div class="linea-1450">
        <a itemtype="telephone" href="tel:1450">
          <x-fak-solid-phone-rotary-shield class="-ml-2 -mr-4 scale-75"/>
          1450
        </a>
      </div>

      <div class="app">
        <h3>
          <x-fak-square-alertapichilemu class="scale-150 text-gray-700"/>
          Alerta Pichilemu
        </h3>
        <a href="https://play.google.com/store/apps/details?id=com.josedevcf.app_pichilemu">
          <img src="@asset('images/logos/google-play.svg')" alt="Descarga Alerta Pichilemu en Google Play">
        </a>
      </div>
    </section>

    <section id="logos">
      <x-fak-munipmu-escudotexto class="text-9xl"/>

      <div class="asociados">
        <a href="https://scam.mma.gob.cl/portal/ohiggins/municipalidad/pichilemu" target="_blank"
           title="Sistema de Certificación Ambiental Municipal">
          <x-fak-scam-2/>
        </a>
        <a href="https://municipalidadturistica.sernatur.cl/" target="_blank" title="Municipalidad Turística SERNATUR">
          <x-fak-munituristica/>
        </a>
      </div>
    </section>
  </div>
</footer>
