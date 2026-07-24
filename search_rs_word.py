import os
import re

search_dirs = [
    r"c:\xampp2\htdocs\bank\resources\views",
    r"c:\xampp2\htdocs\bank\public\assets"
]

# Pattern matching standalone "Rs" surrounded by symbols or space
pattern = re.compile(r'(?:[^a-zA-Z]|^)(Rs\.?)(?:[^a-zA-Z]|$)', re.IGNORECASE)

print("Searching for standalone Rs labels...")
matches = 0

for s_dir in search_dirs:
    if not os.path.exists(s_dir):
        continue
    for root, dirs, files in os.walk(s_dir):
        for file in files:
            if file.endswith(('.blade.php', '.js', '.css')):
                filepath = os.path.join(root, file)
                with open(filepath, 'r', encoding='utf-8') as f:
                    content = f.read()
                
                # Check line by line
                lines = content.split('\n')
                for idx, line in enumerate(lines):
                    m = pattern.search(line)
                    if m:
                        # Skip things like "trs" or "prs" or variable names if they are false positives, but let pattern handle it
                        print(f"File: {file} | Line {idx+1}: {line.strip()}")
                        matches += 1

print(f"Done. Matches found: {matches}")
