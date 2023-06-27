import flask

app = flask.Flask(__name__)

@app.route("/")
def index():
    return flask.render_template("index.html")

@app.route("/contact")
def contact():
    return flask.render_template("contact.html")

@app.route("/contact", methods=["POST"])
def contact_post():
    name = flask.request.form["name"]
    email = flask.request.form["email"]
    message = flask.request.form["message"]

    if name == "" or email == "" or message == "":
        return flask.render_template("contact.html", error="Please enter all required fields")

    # TODO: Send email to the specified address

    return flask.render_template("contact.html", success="Your message has been sent")

if __name__ == "__main__":
    app.run(debug=True)
