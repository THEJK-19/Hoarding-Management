import flask

app = flask.Flask(__name__)

@app.route("/")
def index():
    return flask.render_template("index.html")

@app.route("/login")
def login():
    return flask.render_template("login.html")

@app.route("/signup")
def signup():
    return flask.render_template("signup.html")

@app.route("/login", methods=["POST"])
def login_post():
    email = flask.request.form["email"]
    password = flask.request.form["password"]

    if email == "admin@example.com" and password == "password":
        flask.session["logged_in"] = True
        return flask.redirect("/")
    else:
        return flask.render_template("login.html", error="Invalid email or password")

@app.route("/signup", methods=["POST"])
def signup_post():
    name = flask.request.form["name"]
    password = flask.request.form["password"]

    if name == "" or password == "":
        return flask.render_template("signup.html", error="Please enter all required fields")

    # TODO: Add user to database

    flask.session["logged_in"] = True
    return flask.redirect("/")

if __name__ == "__main__":
    app.run(debug=True)
