<!-- Pricing Page Header -->
<section class="text-center py-5">
    <div class="container">
        <h1 class="display-4">Simple, Transparent Pricing</h1>
        <p class="lead">Choose the plan that fits the number of active listings you have each month.</p>
    </div>
</section>


<!-- Pricing Tiers -->
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5 class="display-4 card-title">Core</h5>
                        <p class="fs-1 fw-semibold text-orange mt-2 mb-3">$7,500<span class="fs-4 fw-normal">/month</span></p>
                        <ul class="list-unstyled text-left ml-5">
                            <li>✔ Full Service Marketing</li>
                            <li>✔ Full Service Sales</li>
                            <li>✔ Full Service Strategy</li>
                            <li>✔ Ideal for 1-2 active homes for sale</li>
                        </ul>
                        <a href="#" class="btn btn-primary mt-3">Choose Core</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-lg">
                    <div class="card-body">
                        <h5 class="display-4 card-title">Growth</h5>
                        <p class="fs-1 fw-semibold text-orange mt-2 mb-3">$14,500<span class="fs-4 fw-normal">/month</span></p>
                        <ul class="list-unstyled text-left ml-5">
                            <li>✔ Full Service Marketing</li>
                            <li>✔ Full Service Sales</li>
                            <li>✔ Full Service Strategy</li>
                            <li>✔ Ideal for 3-5 active homes for sale</li>
                        </ul>
                        <a href="#" class="btn btn-primary mt-3">Choose Growth</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5 class="display-4 card-title">Elite</h5>
                        <p class="fs-1 fw-semibold text-orange mt-2 mb-3">$24,500<span class="fs-4 fw-normal">/month</span></p>
                        <ul class="list-unstyled text-left ml-5">
                            <li>✔ Full Service Marketing</li>
                            <li>✔ Full Service Sales</li>
                            <li>✔ Full Service Strategy</li>
                            <li>✔ Ideal for 6-10 active homes for sale</li>
                        </ul>
                        <a href="#" class="btn btn-primary mt-3">Choose Elite</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Commission Cost Comparison -->
<section class="bg-white text-center">
    <div class="container my-5">
        <div class="text-center">
        <h2 class="fw-bold">Full-Service Sales + Marketing for Builders</h2>
        <p class="lead mt-3">
            We offer everything you need to market and sell your communities—
            <strong>without the commission cuts or patchwork of vendors.</strong>
        </p>
    </div>

    <hr class="my-5">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="fw-bold">Why It Works</h3>
            <p class="mt-3">
                Traditional real estate agents charge <strong>2.5% to 3% per sale.</strong><br>
                On a $500,000 home, that’s <strong>$12,500 to $15,000 per home.</strong><br>
                If you’re building 10 homes, you’re paying up to <strong>$150,000 in commissions</strong>—and that’s just for sales, with no marketing support.
            </p>
            <p class="mt-4">
                We give you <strong>full-service marketing + professional sales representation</strong>—for one flat monthly fee.<br>
                <strong>No commissions. No per-listing charges. No surprises. Just results.</strong>
            </p>
        </div>
    </div>
    <blockquote class="blockquote p-4 my-4 border-start border-4 border-primary bg-light rounded">
        <p class="mb-0 fs-5">We&#39;re not agents chasing transactions — we&#39;re strategic partners focused on building your brand, moving communities, and protecting your margins. Our pricing reflects the strategy and content we deliver to accelerate absorption and drive long-term success.</p>
    </blockquote>
            <!-- <div class="mt-4">
            <a href="#pricing" class="btn btn-outline-primary btn-lg px-4">See Your Savings</a>-->
</section>

<!-- Cost Saving Calculator -->
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-sm">
        <div class="card-body">
          <h2 class="card-title text-center mb-4">Builder Savings Calculator</h2>

          <div class="mb-3">
            <label for="homePrice" class="form-label">Average Home Price ($)</label>
            <input type="number" class="form-control" id="homePrice" placeholder="e.g. 450000">
          </div>

          <div class="mb-3">
            <label for="commission" class="form-label">Typical Seller Commission (%)</label>
            <input type="number" class="form-control" id="commission" placeholder="e.g. 3">
          </div>

          <div class="mb-3">
            <label for="homesPerMonth" class="form-label">Average Homes Sold Per Month</label>
            <input type="number" class="form-control" id="homesPerMonth" placeholder="e.g. 4">
          </div>

          <div class="d-grid">
            <button class="btn btn-primary" onclick="calculateSavings()">Calculate</button>
          </div>

          <div class="mt-4 p-4 bg-body-tertiary border rounded" id="results" style="display: none;">
            <h5 class="mb-3 text-success">Results</h5>
            <p><strong>Current Commission Cost:</strong> <span id="currentCost"></span> / month</p>
            <p><strong>New Flat Monthly Fee:</strong> <span id="newCost"></span></p>
            <p><strong>Monthly Savings:</strong> <span id="monthlySavings"></span></p>
            <p><strong>Annual Savings:</strong> <span id="annualSavings"></span></p>
            <p><strong>Pricing Tier:</strong> <span id="tier" class="text-primary"></span></p>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function calculateSavings() {
    const homePrice = parseFloat(document.getElementById("homePrice").value);
    const commission = parseFloat(document.getElementById("commission").value) / 100;
    const homesPerMonth = parseInt(document.getElementById("homesPerMonth").value);

    if (isNaN(homePrice) || isNaN(commission) || isNaN(homesPerMonth)) {
      alert("Please fill in all fields with valid numbers.");
      return;
    }

    const currentCost = homePrice * commission * homesPerMonth;

    let tier = '';
    let newCost = 0;

    if (homesPerMonth <= 2) {
      tier = 'Core';
      newCost = 7495;
    } else if (homesPerMonth <= 5) {
      tier = 'Growth';
      newCost = 14495;
    } else if (homesPerMonth <= 10) {
      tier = 'Elite';
      newCost = 24495;
    } else {
      tier = 'Custom';
      newCost = 24495 + (homesPerMonth - 10) * 2500;
    }

    const monthlySavings = currentCost - newCost;
    const annualSavings = monthlySavings * 12;

    document.getElementById("currentCost").textContent = `$${currentCost.toLocaleString(undefined, {maximumFractionDigits: 0})}`;
    document.getElementById("newCost").textContent = `$${newCost.toLocaleString()}`;
    document.getElementById("monthlySavings").textContent = `$${monthlySavings.toLocaleString(undefined, {maximumFractionDigits: 0})}`;
    document.getElementById("annualSavings").textContent = `$${annualSavings.toLocaleString(undefined, {maximumFractionDigits: 0})}`;
    document.getElementById("tier").textContent = tier;

    document.getElementById("results").style.display = 'block';
  }
</script>
