
from jinja2 import Environment

def test_template():
    # Tests that the template is well formed
    env = Environment()
    with open("index.html") as template:
        env.parse(template.read())
