import os
import re

workspace_dir = r"c:\xampp2\htdocs\bank"
pattern = re.compile(r'(?:Rs\.?\s*\d+|\d+\s*Rs\.?)', re.IGNORECASE)

print("Searching entire workspace for Rs...")
matches_found = 0

for root, dirs, files in os.walk(workspace_dir):
    # Exclude vendor, storage/framework, node_modules, and git directories
    if any(p in root for p in ['vendor', '.git', 'storage\\framework', 'node_modules', 'bank_static_backup']):
        continue
    for file in files:
        if file.endswith(('.php', '.js', '.css', '.html', '.json', '.txt', '.md')):
            filepath = os.path.join(root, file)
            try:
                with open(filepath, 'r', encoding='utf-8') as f:
                    content = f.read()
            except Exception:
                continue
            
            matches = list(pattern.finditer(content))
            if matches:
                print(f"File: {filepath}")
                for m in matches:
                    start = max(0, m.start() - 30)
                    end = min(len(content), m.end() + 30)
                    snippet = content[start:end].replace('\n', ' ')
                    print(f"  Snippet: ... {snippet} ...")
                    matches_found += 1

print(f"Finished. Total matches found: {matches_found}")
