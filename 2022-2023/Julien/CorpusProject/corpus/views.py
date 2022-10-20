from django.shortcuts import render

from corpus.models import Corpus

from random import randint


def index(request):

    names = Corpus.objects.all()

    new_name = (
        names[randint(0, len(names) - 1)].text[:2]
        + names[randint(0, len(names) - 1)].text[2:4]
        + names[randint(0, len(names) - 1)].text[-2:]
    )

    return render(request, "index.html", {"new_name": new_name})
