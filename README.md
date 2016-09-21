Microsoft Computer Vision package
===================


This package allows you to Analyze an image, Read text in images, Generate a thumbnail.

----------

How to get `subscriptionKey`
---------------

 1. Go to the [Service page](https://www.microsoft.com/cognitive-services/en-us/computer-vision-api)
 2. Create [Microsoft account](https://www.microsoft.com/cognitive-services/en-US/subscriptions) or log in. 
 3. Choose "Computer Vision - Preview" to create new subscription
 4. In **Key** section choose Key1 or Key2 and press <kbd>Show</kbd> or  <kbd>Copy</kbd>




**analyzeImage**
-------

This operation extracts a rich set of visual features based on the image content. 

| Field                         | Type      | Description   |
| -------                       | ----      | ---           |
| `subscriptionKey`             | string    |  The api key obtained from Microsoft Cognitive Services.    |
| `image`                       | string    |  Supported input methods: raw image binary or image URL.   |
| `details (optional)`          | string    |  A string indicating which domain-specific details to return. Multiple values should be comma-separated. Valid visual feature types include: **Celebrities** - identifies celebrities if detected in the image. |
| `visualFeatures (optional)`   | string    |  A string indicating what visual feature types to return. Multiple values should be comma-separated. Valid visual feature types include: **Categories** - categorizes image content according to a taxonomy defined in documentation. **Tags** - tags the image with a detailed list of words related to the image content. **Description** - describes the image content with a complete English sentence. **Faces** - detects if faces are present. If present, generate coordinates, gender and age. **ImageType** - detects if image is clipart or a line drawing. **Color** - determines the accent color, dominant color, and whether an image is black&white. **Adult** - detects if the image is pornographic in nature (depicts nudity or a sex act). Sexually suggestive content is also detected. |


**Request example**

    {
        "subscriptionKey": "XXXXXXX",
        "image": "http://example.com/images/test.jpg",
        "visualFeatures": "Description"
    }

**Response example**

    {
    "callback": "success",
    "contextWrites": {
        "to": {
            "description": {
                "tags": [
                    "sign",
                    "green",
                    "grass",
                    "sitting",
                    "street",
                    "top",
                    "truck",
                    "side",
                    "large",
                    "white",
                    "display",
                    "train",
                    "bus"
                ],
                "captions": [
                    {
                        "text": "a sign sitting on the side of a truck",
                        "confidence": 0.18976755326096
                    }
                ]
            },
            "requestId": "6100d0fa-f311-434c-b549-c1ab5e094077",
            "metadata": {
                "width": 610,
                "height": 610,
                "format": "Png"
            }
        }
    }


**describeImage**
-------

This operation generates a description of an image in human readable language with complete sentences. The description is based on a collection of content tags, which are also returned by the operation. More than one description can be generated for each image. Descriptions are ordered by their confidence score. All descriptions are in English. 

| Field                         | Type      | Description   |
| -------                       | ----      | ---           |
| `subscriptionKey`             | string    |  The api key obtained from Microsoft Cognitive Services.    |
| `image`                       | string    |  Supported input methods: raw image binary or image URL.   |
| `maxCandidates (optional)`    | string    |  Maximum number of candidate descriptions to be returned. The default is 1. |

**Request example**

    {
        "subscriptionKey": "XXXXXXX",
        "image": "http://example.com/images/test.jpg",
        "maxCandidates": "2"
    }

**Response example**

    {
        "callback": "success",
        "contextWrites": {
            "to": {
                "tags": [
                    "sign",
                    "green",
                    "grass",
                    "sitting",
                    "street",
                    "top",
                    "truck",
                    "side",
                    "large",
                    "white",
                    "display",
                    "train",
                    "bus"
                ],
                "captions": [
                    {
                        "text": "a sign sitting on the side of a truck",
                        "confidence": 0.18976755326096
                    },
                    {
                        "text": "a sign on the side of a truck",
                        "confidence": 0.18876755326096
                    }
                ]
            }
        }
    }

**getThumbnail**
-------

This operation generates a thumbnail image with the user-specified width and height. By default, the service analyzes the image, identifies the region of interest (ROI), and generates smart cropping coordinates based on the ROI. Smart cropping helps when you specify an aspect ratio that differs from that of the input image.

| Field                         | Type      | Description   |
| -------                       | ----      | ---           |
| `subscriptionKey`             | string    |  The api key obtained from Microsoft Cognitive Services.    |
| `image`                       | string    |  Supported input methods: raw image binary or image URL.   |
| `width`                       | number    |  Width of the thumbnail. It must be between 1 and 1024. Recommended minimum of 50. |
| `height`                      | number    |  Height of the thumbnail. It must be between 1 and 1024. Recommended minimum of 50. |
| `smartCropping (optional)`    | boolean   |  Boolean flag for enabling smart cropping. |

**Request example**

    {
        "subscriptionKey": "XXXXXXX",
        "image": "http://example.com/images/test.jpg",
        "width": 200,
        "height": 200,
        "smartCropping": true
    }

**Response example**

    [Binary image data]


**ocr**
-------

Optical Character Recognition (OCR) detects text in an image and extracts the recognized characters into a machine-usable character stream.

| Field                         | Type      | Description   |
| -------                       | ----      | ---           |
| `subscriptionKey`             | string    |  The api key obtained from Microsoft Cognitive Services.    |
| `image`                       | string    |  Supported input methods: raw image binary or image URL.   |
| `language (optional)`         | string    |  The BCP-47 language code of the text to be detected in the image.The default value is "unk", then the service will auto detect the language of the text in the image. **Supported languages**: unk (AutoDetect), zh-Hans (ChineseSimplified), zh-Hant (ChineseTraditional), cs (Czech), da (Danish), nl (Dutch), en (English), fi (Finnish), fr (French), de (German), el (Greek), hu (Hungarian), it (Italian), Ja (Japanese), ko (Korean), nb (Norwegian), pl (Polish), pt (Portuguese, ru (Russian), es (Spanish), sv (Swedish), tr (Turkish) |
| `detectOrientation (optional)`  | boolean  |  Whether detect the text orientation in the image. With detectOrientation=true the OCR service tries to detect the image orientation and correct it before further processing (e.g. if it's upside-down).   |

**Request example**

    {
        "subscriptionKey": "XXXXXXX",
        "image": "http://cache.lovethispic.com/uploaded_images/blogs/Farmer-Sprays-Poop-All-Over-Protestors-Trespassing-On-His-Land-10417-1.png",
        "detectOrientation": true
    }

**Response example**

    {
        "callback": "success",
        "contextWrites": {
            "to": {
                "language": "en",
                "textAngle": 0,
                "orientation": "Up",
                "regions": [
                    {
                        "boundingBox": "62,206,472,184",
                        "lines": [
                            {
                                "boundingBox": "155,206,280,44",
                                "words": [
                                    {
                                        "boundingBox": "155,207,137,39",
                                        "text": "Farmer"
                                    },
                                    {
                                        "boundingBox": "302,206,133,44",
                                        "text": "Sprays"
                                    }
                                ]
                            },
                            {
                                "boundingBox": "67,256,465,44",
                                "words": [
                                    {
                                        "boundingBox": "67,257,94,43",
                                        "text": "Poop"
                                    },
                                    {
                                        "boundingBox": "170,257,50,38",
                                        "text": "All"
                                    },
                                    {
                                        "boundingBox": "231,256,87,40",
                                        "text": "Over"
                                    },
                                    {
                                        "boundingBox": "329,257,203,39",
                                        "text": "Protestors"
                                    }
                                ]
                            },
                            {
                                "boundingBox": "62,306,472,44",
                                "words": [
                                    {
                                        "boundingBox": "62,307,242,43",
                                        "text": "Trespassing"
                                    },
                                    {
                                        "boundingBox": "315,306,48,40",
                                        "text": "On"
                                    },
                                    {
                                        "boundingBox": "375,307,59,39",
                                        "text": "His"
                                    },
                                    {
                                        "boundingBox": "445,307,89,39",
                                        "text": "Land"
                                    }
                                ]
                            },
                            {
                                "boundingBox": "173,366,236,24",
                                "words": [
                                    {
                                        "boundingBox": "173,366,236,24",
                                        "text": "www.lovethispic.com"
                                    }
                                ]
                            }
                        ]
                    }
                ]
            }
        }
    }


**tagImage**
-------

This operation generates a list of words, or tags, that are relevant to the content of the supplied image. 

| Field                         | Type      | Description   |
| -------                       | ----      | ---           |
| `subscriptionKey`             | string    |  The api key obtained from Microsoft Cognitive Services.    |
| `image`                       | string    |  Supported input methods: raw image binary or image URL.   |

**Request example**

    {
        "subscriptionKey": "XXXXXXX",
        "image": "http://example.com/images/test.jpg"
    }

**Response example**

    {
        "callback": "success",
        "contextWrites": {
            "to": {
                "tags": [
                    {
                        "name": "sign",
                        "confidence": 0.9311295747757
                    },
                    {
                        "name": "green",
                        "confidence": 0.75948804616928
                    }
                ],
                "requestId": "78d77cad-b6c2-41fc-8264-4efd95028fc5",
                "metadata": {
                    "width": 610,
                    "height": 610,
                    "format": "Png"
                }
            }
        }
    }
