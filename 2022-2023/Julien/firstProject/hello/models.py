from unittest.util import _MAX_LENGTH
from django.db import models


class Article(models.Model):
    title = models.CharField(max_length=512)
    body = models.TextField(blank=True, default="")
