<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];
t=b.createElement(e);t.async=!0;
t.src=v;
s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s);
}(window, document,'script','https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '26293736610250920');   // <-- add your Pixel ID
fbq('track', 'PageView');
fbq('track', 'ViewContent');         // optional but recommended
</script>
<noscript>
  <img height="1" width="1" style="display:none"
       src="https://www.facebook.com/tr?id=YOUR_PIXEL_ID_HERE&ev=PageView&noscript=1"/>
</noscript>
<!-- End Meta Pixel Code -->


<!-- HERO (above the fold) -->
<section
    class="hero d-flex align-items-end"
    style="
    min-height:100vh;
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    background-image:url('<?= BASE_URL ?>/images/builders/reverehomes/src-b5-502/feature.webp');
  "  
    aria-label="3350 E Baywater hero photo"
>
  <div class="container pb-5 position-relative">
    <div class="row">
      <div class="col-lg-8 text-white">
        <div class="d-inline-flex flex-wrap gap-2 mb-3">
          <span class="badge text-bg-light text-dark">MLS #2129337</span>
          <span class="badge text-bg-light text-dark">Active</span>
          <span class="badge text-bg-light text-dark">Move-in Ready</span>
          <span class="badge text-bg-light text-dark">No HOA</span>
        </div>

        <h1 class="display-5 fw-bold mb-2">3350 E Baywater, Eagle Mountain, UT 84005</h1>
        <p class="lead mb-3">Santa Anna • 2-Story • 4 Beds • 2.5 Baths • 2,958 Sq Ft • 2-Car Garage</p>

        <div class="d-flex flex-wrap align-items-center gap-3">
          <div class="fs-2 fw-bold">$554,900</div>
          <div class="text-white-50">($189 / Sq Ft)</div>
        </div>

        <div class="mt-4 d-flex flex-wrap gap-2">
          <a href="#photos" class="btn btn-light btn-lg">View Photos</a>
          <a href="#video" class="btn btn-outline-light btn-lg">Watch Video</a>
          <a href="#contact" class="btn btn-warning btn-lg">Request Info</a>
        </div>

        <p class="small text-white-50 mt-4 mb-0">
          *Builder offering a 3% incentive toward closing costs or rate buydown with use of seller’s preferred lender.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- MAIN CONTENT -->
<main class="bg-light">
  <div class="container py-5">

    <!-- QUICK FACTS + CONTACT (sticky on desktop) -->
    <section class="row g-4 align-items-start" id="details">
      <div class="col-lg-8">
        <div class="card shadow-sm border-0">
          <div class="card-body p-4">
            <h2 class="h4 mb-3">Highlights</h2>

            <div class="row g-3">
              <div class="col-md-6">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item bg-transparent px-0 d-flex justify-content-between">
                    <span class="text-muted">Price</span><span class="fw-semibold">$554,900</span>
                  </li>
                  <li class="list-group-item bg-transparent px-0 d-flex justify-content-between">
                    <span class="text-muted">Beds</span><span class="fw-semibold">4</span>
                  </li>
                  <li class="list-group-item bg-transparent px-0 d-flex justify-content-between">
                    <span class="text-muted">Baths</span><span class="fw-semibold">2.5</span>
                  </li>
                  <li class="list-group-item bg-transparent px-0 d-flex justify-content-between">
                    <span class="text-muted">Living Area</span><span class="fw-semibold">2,958 Sq Ft</span>
                  </li>
                  <li class="list-group-item bg-transparent px-0 d-flex justify-content-between">
                    <span class="text-muted">Style</span><span class="fw-semibold">2-Story</span>
                  </li>
                </ul>
              </div>

              <div class="col-md-6">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item bg-transparent px-0 d-flex justify-content-between">
                    <span class="text-muted">Subdivision</span><span class="fw-semibold">Spring Run</span>
                  </li>
                  <li class="list-group-item bg-transparent px-0 d-flex justify-content-between">
                    <span class="text-muted">Year Built</span><span class="fw-semibold">2025</span>
                  </li>
                  <li class="list-group-item bg-transparent px-0 d-flex justify-content-between">
                    <span class="text-muted">Lot</span><span class="fw-semibold">0.11 acres</span>
                  </li>
                  <li class="list-group-item bg-transparent px-0 d-flex justify-content-between">
                    <span class="text-muted">Garage</span><span class="fw-semibold">2-Car Attached</span>
                  </li>
                  <li class="list-group-item bg-transparent px-0 d-flex justify-content-between">
                    <span class="text-muted">HOA</span><span class="fw-semibold">No</span>
                  </li>
                </ul>
              </div>
            </div>

            <hr class="my-4">

            <h3 class="h5 mb-2">Description</h3>
            <p class="mb-0">
              This thoughtfully designed home has <strong>4 finished bedrooms</strong> and
              <strong>2.5 bathrooms</strong>, with room to grow in the basement. A <strong>separate basement
              entrance</strong> and <strong>rough plumbing for a future ADU</strong> (kitchen sink and laundry)
              provide strong long-term flexibility. Upstairs, all four bedrooms and the laundry room are grouped
              together for convenience and privacy. The main level features <strong>9' ceilings</strong>, a large
              walk-in pantry, and an open, functional layout. Finishes include <strong>quartz countertops</strong>,
              white cabinetry, stainless steel appliances, and durable LVP and carpet flooring throughout.
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-4" id="contact">
        <div class="card shadow-sm border-0 position-sticky" style="top: 1rem;">
          <div class="card-body p-4">
            <h2 class="h5 mb-1">Request Info / Showing</h2>
            <p class="text-muted small mb-3">We’ll reach out quickly with availability and details.</p>

            <form id="leadForm" class="needs-validation" novalidate>
              <div class="mb-3">
                <label for="firstName" class="form-label">First name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
                <div class="invalid-feedback">Please enter your first name.</div>
              </div>

              <div class="mb-3">
                <label for="lastName" class="form-label">Last name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
                <div class="invalid-feedback">Please enter your last name.</div>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback">Please enter a valid email.</div>
              </div>

              <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Optional">
              </div>

              <div class="mb-3">
                <label for="message" class="form-label">What would you like?</label>
                <textarea class="form-control" id="message" name="message" rows="3" placeholder="Tour request, questions, timeline, etc."></textarea>
              </div>

              <!-- Hidden context -->
              <input type="hidden" name="listingAddress" value="3350 E Baywater, Eagle Mountain, UT 84005">
              <input type="hidden" name="mlsNumber" value="2129337">
              <input type="hidden" name="listingPrice" value="554900">

              <button type="submit" class="btn btn-warning w-100 btn-lg">Send</button>

              <div id="leadStatus" class="mt-3 small"></div>
            </form>

            <hr class="my-4">

            <div class="small">
              <div class="fw-semibold">Listing Agent</div>
              <div>Kemish W. Hendershot</div>
              <div><a href="tel:+12082502488">208-250-2488</a> • <a href="mailto:kemish@thekatalyst.group">kemish@thekatalyst.group</a></div>

              <div class="mt-3 fw-semibold">Co-Agent</div>
              <div>Kaleb W. Hendershot</div>
              <div><a href="tel:+13857895030">385-789-5030</a> • <a href="mailto:kaleb@thekatalyst.group">kaleb@thekatalyst.group</a></div>

              <div class="mt-3 text-muted">Brokerage: Real Broker, LLC • <a href="tel:+18015059668">801-505-9668</a></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- PHOTOS -->
    <section class="mt-5" id="photos">
      <div class="d-flex align-items-end justify-content-between flex-wrap gap-2 mb-3">
        <div>
          <h2 class="h4 mb-0">Photos</h2>
        </div>
        <a href="#details" class="btn btn-outline-secondary btn-sm">Back to Top</a>
      </div>

      <div class="row g-3">
        <!-- Make the first image a larger featured photo -->
        <div class="col-12">
          <div class="card border-0 shadow-sm overflow-hidden">
            <img
              src="<?php echo BASE_URL; ?>/images/builders/reverehomes/src-b5-502/feature.webp"
              class="img-fluid"
              alt="Featured photo"
              loading="lazy"
            >
          </div>
        </div>

        <!-- Thumbnails -->
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card border-0 shadow-sm overflow-hidden">
            <img src="<?php echo BASE_URL; ?>/images/builders/reverehomes/src-b5-502/living.webp" class="img-fluid" alt="Photo 1" loading="lazy">
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card border-0 shadow-sm overflow-hidden">
            <img src="<?php echo BASE_URL; ?>/images/builders/reverehomes/src-b5-502/kitchen.webp" class="img-fluid" alt="Photo 2" loading="lazy">
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card border-0 shadow-sm overflow-hidden">
            <img src="<?php echo BASE_URL; ?>/images/builders/reverehomes/src-b5-502/pantry.webp" class="img-fluid" alt="Photo 3" loading="lazy">
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card border-0 shadow-sm overflow-hidden">
            <img src="<?php echo BASE_URL; ?>/images/builders/reverehomes/src-b5-502/entry.webp" class="img-fluid" alt="Photo 4" loading="lazy">
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card border-0 shadow-sm overflow-hidden">
            <img src="<?php echo BASE_URL; ?>/images/builders/reverehomes/src-b5-502/basement.webp" class="img-fluid" alt="Photo 5" loading="lazy">
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card border-0 shadow-sm overflow-hidden">
            <img src="<?php echo BASE_URL; ?>/images/builders/reverehomes/src-b5-502/adu-access.webp" class="img-fluid" alt="Photo 6" loading="lazy">
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card border-0 shadow-sm overflow-hidden">
            <img src="<?php echo BASE_URL; ?>/images/builders/reverehomes/src-b5-502/backyard.webp" class="img-fluid" alt="Photo 7" loading="lazy">
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card border-0 shadow-sm overflow-hidden">
            <img src="<?php echo BASE_URL; ?>/images/builders/reverehomes/src-b5-502/primary-bedroom.webp" class="img-fluid" alt="Photo 8" loading="lazy">
          </div>
        </div>
      </div>
    </section>

    <!-- VIDEO -->
    <section class="mt-5" id="video">
      <h2 class="h4 mb-3">Video Tour</h2>
      <div class="card shadow-sm border-0">
        <div class="card-body p-3">
          <div class="ratio ratio-16x9">
            <iframe
              src="https://www.youtube-nocookie.com/embed/ZuVqa1Q-1Yg"
              title="YouTube video tour"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              allowfullscreen
            ></iframe>
          </div>        
        </div>
      </div>
    </section>

    <!-- NEIGHBORHOOD / SCHOOLS -->
    <section class="mt-5" id="neighborhood">
      <div class="row g-4">
        <div class="col-lg-6">
          <div class="card shadow-sm border-0 h-100">
            <div class="card-body p-4">
              <h2 class="h5 mb-3">Neighborhood</h2>
              <ul class="mb-0">
                <li><strong>Subdivision:</strong> Spring Run</li>
                <li><strong>City:</strong> Eagle Mountain, UT 84005</li>
                <li><strong>No HOA</strong></li>
                <li><strong>Lot features:</strong> Curb &amp; gutter, paved road, sidewalks</li>
                <li><strong>Connectivity:</strong> Fiber</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card shadow-sm border-0 h-100">
            <div class="card-body p-4">
              <h2 class="h5 mb-3">Schools</h2>
              <ul class="mb-0">
                <li><strong>District:</strong> Alpine</li>
                <li><strong>Elementary:</strong> Black Ridge</li>
                <li><strong>Middle:</strong> Sage Canyon</li>
                <li><strong>High:</strong> Cedar Valley</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FEATURES -->
    <section class="mt-5" id="features">
      <h2 class="h4 mb-3">Features &amp; Finishes</h2>
      <div class="row g-3">
        <div class="col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
              <div class="fw-semibold">Kitchen</div>
              <div class="text-muted small">Quartz countertops, white cabinetry, stainless appliances, large walk-in pantry</div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
              <div class="fw-semibold">Layout</div>
              <div class="text-muted small">Open main level with 9' ceilings • All bedrooms + laundry upstairs</div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
              <div class="fw-semibold">Basement</div>
              <div class="text-muted small">Daylight/full with separate entrance • Rough plumbing for future ADU</div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
              <div class="fw-semibold">Exterior</div>
              <div class="text-muted small">Stone, stucco, cement board • Open porch • Open patio</div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
              <div class="fw-semibold">Comfort</div>
              <div class="text-muted small">Forced air gas heat • Central air • Smart thermostat(s)</div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
              <div class="fw-semibold">Parking</div>
              <div class="text-muted small">2-car attached garage with opener • Concrete driveway</div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
</main>

<!-- BOOTSTRAP + FORM SUBMIT -->
<script>
  (function () {
    const form = document.getElementById('leadForm');
    const statusEl = document.getElementById('leadStatus');

    function setStatus(msg, type) {
      statusEl.className = 'mt-3 small';
      if (type === 'success') statusEl.classList.add('text-success');
      if (type === 'error') statusEl.classList.add('text-danger');
      if (type === 'info') statusEl.classList.add('text-muted');
      statusEl.textContent = msg;
    }

    form.addEventListener('submit', async function (e) {
      e.preventDefault();

      if (!form.checkValidity()) {
        e.stopPropagation();
        form.classList.add('was-validated');
        setStatus('Please correct the highlighted fields and try again.', 'error');
        return;
      }

      setStatus('Sending…', 'info');

      const payload = Object.fromEntries(new FormData(form).entries());

      try {
        const res = await fetch('/protected/api/lead.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(payload),
          credentials: 'same-origin'
        });

        const text = await res.text();
        let data = {};
        try { data = JSON.parse(text); } catch (_) {}

        if (!res.ok || !data.ok) {
          const msg = (data && data.error) ? data.error : (text || 'Request failed');
          throw new Error(msg);
        }

        // Dedupe with server-side CAPI using the returned event_id
        if (window.fbq && data.event_id) {
          fbq('track', 'Lead', {}, { eventID: data.event_id });
        } else if (window.fbq) {
          // fallback (shouldn't happen if endpoint returns event_id)
          fbq('track', 'Lead');
        }

        form.reset();
        form.classList.remove('was-validated');
        setStatus('Thanks! We received your request and will reach out shortly.', 'success');

      } catch (err) {
        console.error(err);
        setStatus('Sorry — something went wrong. Please call/text 208-250-2488.', 'error');
      }
    });
  })();
</script>