from django.db import models


class Corpus(models.Model):
    text = models.CharField(max_length=512)
