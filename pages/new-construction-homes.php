<!-- Page Hero (Different from Homepage) -->
<section class="container my-5">
  <div class="row g-4 align-items-center">
    <div class="col-lg-7">
      <h1 class="mb-3">New Construction Homes in Utah</h1>
      <p class="lead mb-4">
        This page is built to help you <strong>shop smarter</strong>: understand the process, compare options, and request a curated list
        based on your budget, timeline, and preferred cities.
      </p>

      <div class="d-flex flex-column flex-sm-row gap-3">
        <a href="#finder" class="btn btn-primary btn-lg">Use the Home Finder</a>
        <a href="#featured" class="btn btn-outline-primary btn-lg">See Featured Community</a>
      </div>

      <div class="text-muted small mt-3">
        <i class="bi bi-info-circle me-1"></i>
        Listing relationships vary by community. We clearly disclose when we represent a builder/community vs. act as a buyer’s representative.
      </div>
    </div>

    <div class="col-lg-5">
      <div class="bg-light rounded p-4 p-md-5 h-100">
        <div class="text-uppercase small text-muted fw-semibold">Quick Request</div>
        <h2 class="h4 mt-2 mb-3">Get a curated list</h2>
        <p class="mb-4">
          Tell us what you want and we’ll send options that fit—move-in ready and to-be-built.
        </p>

        <!-- Replace with your form handler -->
        <form>
          <div class="mb-3">
            <label class="form-label small text-muted">Budget range</label>
            <select class="form-select">
              <option selected>Select a range</option>
              <option>Under $400k</option>
              <option>$400k–$500k</option>
              <option>$500k–$650k</option>
              <option>$650k+</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label small text-muted">Timeline</label>
            <select class="form-select">
              <option selected>Select timeline</option>
              <option>Move-in ready (0–60 days)</option>
              <option>3–6 months</option>
              <option>6–12 months (to-be-built)</option>
              <option>Just researching</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label small text-muted">Cities</label>
            <input class="form-control" placeholder="Eagle Mountain, Salem, Santaquin..." />
          </div>

          <div class="d-grid">
            <a href="<?php echo BASE_URL; ?>/contact" class="btn btn-primary btn-lg">Request Options</a>
          </div>

          <div class="text-muted small mt-3">
            Brokerage/disclosure text can go here.
          </div>
        </form>
      </div>
    </div>
  </div>
</section>


<!-- Education Section (Tabs) -->
<section class="container my-5">
  <div class="row g-4 align-items-center">
    <div class="col-lg-5">
      <h2 class="mb-3">Know this before you buy</h2>
      <p class="text-muted mb-0">
        Most buyer frustration comes from misunderstandings: what’s included, what upgrades matter, and how timelines actually work.
        Here’s the short version.
      </p>
    </div>

    <div class="col-lg-7">
      <div class="bg-white rounded shadow-sm p-4 p-md-5">
        <ul class="nav nav-pills mb-4" id="ncTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="tab-included" data-bs-toggle="pill" data-bs-target="#pane-included" type="button" role="tab">
              Included vs. Upgrades
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-timeline" data-bs-toggle="pill" data-bs-target="#pane-timeline" type="button" role="tab">
              Timelines
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-costs" data-bs-toggle="pill" data-bs-target="#pane-costs" type="button" role="tab">
              Real Costs
            </button>
          </li>
        </ul>

        <div class="tab-content" id="ncTabsContent">
          <div class="tab-pane fade show active" id="pane-included" role="tabpanel">
            <p class="mb-3">
              Two homes can look identical online but price differently because of “included features” vs. upgrades.
              We help you identify what’s truly standard and what’s driving the price.
            </p>
            <ul class="mb-0">
              <li>Flooring, cabinets, countertops, appliances</li>
              <li>Lighting packages and electrical add-ons</li>
              <li>Landscaping, fencing, blinds, garage openers</li>
            </ul>
          </div>

          <div class="tab-pane fade" id="pane-timeline" role="tabpanel">
            <p class="mb-3">
              Build timelines can shift due to permitting, inspections, weather, labor schedules, and material availability.
              We’ll help you choose a strategy that matches your move date.
            </p>
            <ul class="mb-0">
              <li>Move-in ready vs. under construction vs. to-be-built</li>
              <li>What “estimated completion” really means</li>
              <li>How to plan inspections and walkthroughs</li>
            </ul>
          </div>

          <div class="tab-pane fade" id="pane-costs" role="tabpanel">
            <p class="mb-3">
              The sticker price isn’t the full picture. New construction often includes lot premiums, design upgrades, and closing costs.
              We help you estimate the real out-the-door number.
            </p>
            <ul class="mb-0">
              <li>Lot premiums and elevation premiums</li>
              <li>Design selections and change orders</li>
              <li>Incentives and preferred lender credits (when available)</li>
            </ul>
          </div>
        </div>

        <div class="mt-4 d-flex flex-column flex-sm-row gap-2">
          <a href="<?php echo BASE_URL; ?>/contact" class="btn btn-primary">Ask a Question</a>
          <a href="#faq" class="btn btn-outline-primary">Read Buyer FAQ</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Featured Community (Optional Deep Link) -->
<section id="featured" class="container my-5">
  <div class="bg-light rounded p-4 p-md-5">
    <div class="row g-4 align-items-center">
      <div class="col-lg-6">
        <div class="text-uppercase small text-muted fw-semibold">Featured Community</div>
        <h2 class="mb-2">Spring Run Park (Eagle Mountain)</h2>
        <p class="mb-4">
          Our current featured community is Spring Run Park by Revere Homes. If you want the fastest updates on availability, pricing,
          and tour options—start here.
        </p>

        <div class="d-flex flex-column flex-sm-row gap-3">
          <a href="<?php echo BASE_URL; ?>/spring-run-park" class="btn btn-primary btn-lg">View Spring Run Park</a>
          <a href="<?php echo BASE_URL; ?>/contact" class="btn btn-outline-primary btn-lg">Request Availability</a>
        </div>

        <p class="text-muted small mt-3 mb-0" id="disclosure">
          <strong>Disclosure:</strong> We represent this community. For other builders/communities, we may act as a buyer’s representative where permitted and available.
        </p>
      </div>

      <div class="col-lg-6">
        <div class="rounded" style="background-image:url('../images/placeholder-community-1.webp'); height: 320px; background-size: cover; background-position: center;">
          <!-- IMAGE PLACEHOLDER -->
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Buyer FAQ (Accordion) -->
<section id="faq" class="container my-5">
  <div class="row g-4">
    <div class="col-lg-4">
      <h2 class="mb-3">Buyer FAQ</h2>
      <p class="text-muted mb-0">
        Quick answers to the most common new construction questions.
      </p>
    </div>

    <div class="col-lg-8">
      <div class="accordion" id="faqAcc">
        <div class="accordion-item">
          <h2 class="accordion-header" id="q1">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#a1">
              Do I pay more to have representation on a new construction home?
            </button>
          </h2>
          <div id="a1" class="accordion-collapse collapse show" data-bs-parent="#faqAcc">
            <div class="accordion-body">
              Often, the builder pays the buyer’s agent fee. Policies vary by builder and by how/when you register at the model home.
              We’ll explain the cleanest way to proceed for the community you’re considering.
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header" id="q2">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a2">
              What’s the difference between move-in ready and to-be-built?
            </button>
          </h2>
          <div id="a2" class="accordion-collapse collapse" data-bs-parent="#faqAcc">
            <div class="accordion-body">
              Move-in ready is completed (or nearly completed). To-be-built means you select a plan and start a build timeline.
              Each path has trade-offs in price, selections, and timeline control.
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header" id="q3">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a3">
              When should inspections happen on a new build?
            </button>
          </h2>
          <div id="a3" class="accordion-collapse collapse" data-bs-parent="#faqAcc">
            <div class="accordion-body">
              Many buyers choose a standard pre-close inspection, and some add phase inspections (like pre-drywall) when available.
              We’ll help you time this based on your builder’s process and schedule.
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header" id="q4">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a4">
              Can I use my own lender?
            </button>
          </h2>
          <div id="a4" class="accordion-collapse collapse" data-bs-parent="#faqAcc">
            <div class="accordion-body">
              Usually yes. Some builders offer preferred-lender incentives. We’ll help you compare options so you understand the real cost.
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- Bottom CTA (Different structure from homepage) -->
<section class="py-5 mb-4 pb-2 bg-light">
  <div class="container mb-0 pb-0">
    <div class="row g-4 align-items-center">
      <div class="col-lg-8">
        <h3 class="mb-2">Want options that actually fit?</h3>
        <p class="mb-0">
          Send your budget, timeline, and preferred cities—we’ll reply with a curated list of new construction options and clear next steps.
        </p>
      </div>
      <div class="col-lg-4 text-lg-end">
        <a href="<?php echo BASE_URL; ?>/contact" class="btn btn-primary btn-lg mb-5">
          Request a Curated List
        </a>
      </div>
    </div>

  </div>
</section>
