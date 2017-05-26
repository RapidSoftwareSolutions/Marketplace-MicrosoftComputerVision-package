[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/MicrosoftComputerVision/functions?utm_source=RapidAPIGitHub_MicrosoftComputerVisionFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

Microsoft Computer Vision package
===================


Extract rich information from images and video.
* Domain: microsoft.com
* Credentials: subscriptionKey

----------

## How to get credentials: 
---------------

 1. Go to the [Computer Vision Page](https://azure.microsoft.com/en-us/try/cognitive-services/?api=computer-vision)
 2. Click "Create"
 ![alt-text](https://storage.googleapis.com/rapid-misc-files/microsoft-compvis-create.png)
 3. Sign up or log in when prompted. 
 4. Choose "Computer Vision - Preview" to create new subscription
 5. In **Key** section choose Key1 or Key2. Copy one of these keys.




**analyzeImage**
-------

This operation extracts a rich set of visual features based on the image content. 

| Field                         | Type      | Description   |
| -------                       | ----      | ---           |
| `subscriptionKey`             | credentials    |  The api key obtained from Microsoft Cognitive Services.    |
| `image`                       | File    |  Supported input methods: raw image binary or image URL.   |
| `details (optional)`          | Array    |  An array indicating which domain-specific details to return.  Valid visual feature types include: **Celebrities** - identifies celebrities if detected in the image. |
| `visualFeatures (optional)`   | Array    |  An array indicating what visual feature types to return. Valid visual feature types include: **Categories** - categorizes image content according to a taxonomy defined in documentation. **Tags** - tags the image with a detailed list of words related to the image content. **Description** - describes the image content with a complete English sentence. **Faces** - detects if faces are present. If present, generate coordinates, gender and age. **ImageType** - detects if image is clipart or a line drawing. **Color** - determines the accent color, dominant color, and whether an image is black&white. **Adult** - detects if the image is pornographic in nature (depicts nudity or a sex act). Sexually suggestive content is also detected. |


**describeImage**
-------

This operation generates a description of an image in human readable language with complete sentences. The description is based on a collection of content tags, which are also returned by the operation. More than one description can be generated for each image. Descriptions are ordered by their confidence score. All descriptions are in English. 

| Field                         | Type      | Description   |
| -------                       | ----      | ---           |
| `subscriptionKey`             | credentials    |  The api key obtained from Microsoft Cognitive Services.    |
| `image`                       | File    |  Supported input methods: raw image binary or image URL.   |
| `maxCandidates (optional)`    | string    |  Maximum number of candidate descriptions to be returned. The default is 1. |

**getThumbnail**
-------

This operation generates a thumbnail image with the user-specified width and height. By default, the service analyzes the image, identifies the region of interest (ROI), and generates smart cropping coordinates based on the ROI. Smart cropping helps when you specify an aspect ratio that differs from that of the input image.

| Field                         | Type      | Description   |
| -------                       | ----      | ---           |
| `subscriptionKey`             | credentials    |  The api key obtained from Microsoft Cognitive Services.    |
| `image`                       | File    |  Supported input methods: raw image binary or image URL.   |
| `width`                       | number    |  Width of the thumbnail. It must be between 1 and 1024. Recommended minimum of 50. |
| `height`                      | number    |  Height of the thumbnail. It must be between 1 and 1024. Recommended minimum of 50. |
| `smartCropping (optional)`    | boolean   |  Boolean flag for enabling smart cropping. |


**ocr**
-------

Optical Character Recognition (OCR) detects text in an image and extracts the recognized characters into a machine-usable character stream.

| Field                         | Type      | Description   |
| -------                       | ----      | ---           |
| `subscriptionKey`             | credentials    |  The api key obtained from Microsoft Cognitive Services.    |
| `image`                       | File    |  Supported input methods: raw image binary or image URL.   |
| `language (optional)`         | string    |  The BCP-47 language code of the text to be detected in the image.The default value is "unk", then the service will auto detect the language of the text in the image. **Supported languages**: unk (AutoDetect), zh-Hans (ChineseSimplified), zh-Hant (ChineseTraditional), cs (Czech), da (Danish), nl (Dutch), en (English), fi (Finnish), fr (French), de (German), el (Greek), hu (Hungarian), it (Italian), Ja (Japanese), ko (Korean), nb (Norwegian), pl (Polish), pt (Portuguese, ru (Russian), es (Spanish), sv (Swedish), tr (Turkish) |
| `detectOrientation (optional)`  | boolean  |  Whether detect the text orientation in the image. With detectOrientation=true the OCR service tries to detect the image orientation and correct it before further processing (e.g. if it's upside-down).   |


**tagImage**
-------

This operation generates a list of words, or tags, that are relevant to the content of the supplied image. 

| Field                         | Type      | Description   |
| -------                       | ----      | ---           |
| `subscriptionKey`             | credentials    |  The api key obtained from Microsoft Cognitive Services.    |
| `image`                       | File    |  Supported input methods: raw image binary or image URL.   |
