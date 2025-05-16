<form id="contact-form" class="needs-validation bg-white p-4 p-md-5 rounded shadow-sm" action="mail-form" novalidate>
    <div class="mb-4">
        <label for="name" class="form-label fw-semibold">Name</label>
        <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Your Name" required>
        <div class="invalid-feedback">Please enter your name.</div>
    </div>

    <div class="mb-4">
        <label for="email" class="form-label fw-semibold">Email</label>
        <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Your Email" required>
        <div class="invalid-feedback">Please enter a valid email address.</div>
    </div>

    <div class="mb-4">
        <label for="message" class="form-label fw-semibold">Message</label>
        <textarea class="form-control form-control-lg" id="message" name="message" rows="5" placeholder="Enter your message..." required></textarea>
        <div class="invalid-feedback">Please enter a message.</div>
    </div>

    <div class="text-end mt-4">
        <button type="submit" class="btn btn-primary btn-lg px-4">Submit</button>
    </div>
</form>