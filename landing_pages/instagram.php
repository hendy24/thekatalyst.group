<!-- /instagram landing page -->
<div class="container my-5">
  <div class="text-center">
    <img src="<?php echo IMAGES; ?>/logo.webp" height="175" alt="TheKatalyst.Group logo">
  </div>

  <div class="text-center mb-5">
    <h1 class="lead">Whether you're looking to buy or ready to build, you're in the right place.</h1>
  </div>

  <div class="row g-4">
    <!-- Buyer / Agent form -->
    <div class="col-md-6">
      <div class="card h-100 shadow rounded">
        <div class="card-body">
          <h3 class="card-title text-primary text-center">Looking to Buy?</h3>
          <p class="card-text">
            We work directly with Utah builders to bring you exclusive access to new homes before they hit the market.
            Be the first to know when homes are available!
          </p>

          <form id="buyerForm" onsubmit="submitBuyerForm(event)">
            <div class="mb-3">
              <label for="buyerName" class="form-label">Name</label>
              <input type="text" class="form-control" id="buyerName" name="buyerName" required>
            </div>

            <div class="mb-3">
              <label for="buyerEmail" class="form-label">Email</label>
              <input type="email" class="form-control" id="buyerEmail" name="buyerEmail" required>
            </div>

            <div class="mb-3">
              <label for="buyerPhone" class="form-label">Phone</label>
              <input type="tel" class="form-control" id="buyerPhone" name="buyerPhone" required>
            </div>

            <div class="mb-3">
              <label for="buyerRole" class="form-label">I'm a…</label>
              <select class="form-select" id="buyerRole" name="buyerRole">
                <option value="Buyer">Buyer</option>
                <option value="Agent">Agent</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Get Early Access</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Builder form -->
    <div class="col-md-6">
      <div class="card h-100 shadow rounded">
        <div class="card-body">
          <h3 class="card-title text-orange text-center">Are You a Home Builder?</h3>
          <p class="card-text">
            We help builders sell homes faster &amp; for less money—combining full-service marketing, sales systems,
            and strategic support that actually work. Let’s talk about growing your business.
          </p>

          <form id="builderForm" onsubmit="submitBuilderForm(event)">
            <div class="mb-3">
              <label for="builderName" class="form-label">Name</label>
              <input type="text" class="form-control" id="builderName" name="builderName" required>
            </div>

            <div class="mb-3">
              <label for="builderCompany" class="form-label">Company</label>
              <input type="text" class="form-control" id="builderCompany" name="builderCompany" required>
            </div>

            <div class="mb-3">
              <label for="builderEmail" class="form-label">Email</label>
              <input type="email" class="form-control" id="builderEmail" name="builderEmail" required>
            </div>

            <div class="mb-3">
              <label for="builderPhone" class="form-label">Phone</label>
              <input type="tel" class="form-control" id="builderPhone" name="builderPhone">
            </div>

            <button type="submit" class="btn btn-primary w-100">Request More Info</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Form validation + fetch submission -->
<script>
  const buyerScriptURL = "https://script.google.com/macros/s/AKfycbxL1dCPJsEhT7huFBsZ9-IH7huZ0G-dF-DKWmCImhd8XtpoYQnC8KsKOeqWRQr0I_th/exec";
  const builderScriptURL = "https://script.google.com/macros/s/AKfycbzMWA3fR-uOpsdFVfvlpRowyXsdjNn3iuqjDdxTiyU7yE9lRpD8Zi1gETur8bCi3YOe/exec";

  // Auto-format phone input fields
  document.getElementById("buyerPhone").addEventListener("input", function (e) {
    formatPhoneInput(e.target);
  });

  document.getElementById("builderPhone").addEventListener("input", function (e) {
    formatPhoneInput(e.target);
  });

  function formatPhoneInput(input) {
    const digits = input.value.replace(/\D/g, '').substring(0, 10);
    let formatted = '';
    if (digits.length > 0) formatted = '(' + digits.substring(0, 3);
    if (digits.length >= 4) formatted += ') ' + digits.substring(3, 6);
    if (digits.length >= 7) formatted += '-' + digits.substring(6, 10);
    input.value = formatted;
  }

  async function submitBuyerForm(e) {
    e.preventDefault();

    const form = document.getElementById("buyerForm");
    const email = form.buyerEmail.value.trim();
    const phone = form.buyerPhone.value.trim();

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phonePattern = /^\(\d{3}\) \d{3}-\d{4}$/;

    if (!emailPattern.test(email)) {
      alert("Please enter a valid email address.");
      return;
    }

    if (!phonePattern.test(phone)) {
      alert("Please enter a valid phone number in the format (xxx) xxx-xxxx.");
      return;
    }

    const formData = new FormData(form);
    const payload = new URLSearchParams();
    for (const pair of formData.entries()) {
      payload.append(pair[0], pair[1]);
    }

    try {
      const res = await fetch(buyerScriptURL, {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: payload.toString()
      });

      if (res.ok) {
        window.location.href = "/thank-you";
      } else {
        alert("Something went wrong. Please try again.");
      }
    } catch (err) {
      alert("Network error. Please try again.");
      console.error(err);
    }
  }

async function submitBuilderForm(e) {
  e.preventDefault();

    const form = document.getElementById("builderForm");
    const email = form.builderEmail.value.trim();
    const phone = form.builderPhone.value.trim();

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phonePattern = /^\(\d{3}\) \d{3}-\d{4}$/;

     if (!emailPattern.test(email)) {
      alert("Please enter a valid email address.");
      return;
    }

    if (!phonePattern.test(phone)) {
      alert("Please enter a valid phone number in the format (xxx) xxx-xxxx.");
      return;
    }   

    const formData = new FormData(form);
    const payload = new URLSearchParams();
    for (const pair of formData.entries()) {
        payload.append(pair[0], pair[1]);
    }

    try {
        const res = await fetch(builderScriptURL, {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: payload.toString(),
    });


    if (res.ok) {
      window.location.href = "/thank-you";
    } else {
      alert("Something went wrong. Please try again.");
    }

  } catch (err) {
    alert("Network error. Please try again.");
    console.error(err);
  }
}
</script>