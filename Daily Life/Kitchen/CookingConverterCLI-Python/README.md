# Cooking Converter (Python)

This is a small interactive and CLI utility to convert between common cooking and baking measurements.

Supported units (examples):

- cup (US cup = 240 mL)
- metric_cup (metric cup = 250 mL)
- tbsp (tablespoon = 15 mL)
- tsp (teaspoon = 5 mL)
- ml (milliliter)
- l (liter)

Features
- Interactive mode: run without arguments and follow prompts.
- CLI quick mode: `python main.py <value> <from_unit> <to_unit>`

Examples

Interactive:

```bash
python CookingConverter-Python/main.py
# follow prompts
```

CLI:

```bash
python CookingConverter-Python/main.py 1 cup tbsp
# -> 1 cup = 16.0000 tbsp (since 1 cup = 240 mL and 1 tbsp = 15 mL)

python CookingConverter-Python/main.py 250 ml metric_cup
# -> 250 ml = 1.0000 metric_cup
```

Notes for contributors
- Keep code clean and commented.
- Configure Git with your name/email before committing so you appear in contributors:

```bash
git config --global user.name "YOUR_GITHUB_USERNAME"
git config --global user.email "YOUR_GITHUB_EMAIL"
```

This file was added as part of the "good first issue" contribution to the Awesome-Calculators repo.
