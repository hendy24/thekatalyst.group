<form id="contact-form" class="needs-validation" action="mail-form">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
    </div>
    <!-- <div class="form-group">
        <label for="location">City</label>
        <input type="text" class="form-control" id="location" name="location" placeholder="City">
    </div> -->

    <div class="form-group">
        <label for="message">Message</label>
            <textarea class="form-control" id="message" rows="5" name="message" placeholder="Tell me a little about how we might be able to help..."></textarea>
    </div>
    <input type="text" name="website" style="display:none">
    <button type="submit" class="btn btn-info float-right">Submit</button>
</form>
