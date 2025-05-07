import sys
from PIL import Image
import pytesseract

if len(sys.argv) < 2:
    print("No image path provided")
    sys.exit(1)

image_path = sys.argv[1]
try:
    image = Image.open(image_path)
    extracted_text = pytesseract.image_to_string(image, config='--psm 6')
    # Encode and decode to handle UTF-8 characters properly
    cleaned_text = extracted_text.encode('utf-8', errors='ignore').decode('utf-8')
    paragraphs = cleaned_text.split('\n\n')
    formatted_text = '\n\n'.join(paragraphs)
    print(formatted_text)
except Exception as e:
    print(f"Error: {e}")
    sys.exit(1)
