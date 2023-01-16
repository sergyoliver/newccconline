import uuid

from django.db import models
import datetime

from django.db.models import Q
from django.utils import dates


class Passage(models.Model):
    class Meta:
        db_table = "tb_passage"

    id = models.BigIntegerField(primary_key=True, blank=True, default=None, editable=False)
    uuid = models.UUIDField(unique=True, blank=True, default=None)
    libelle = models.CharField(max_length=50)
    periode = models.CharField(max_length=20)
    type_periode = models.CharField(max_length=20)
    type_pied = models.CharField(max_length=10)
    active = models.IntegerField(default=1)
    supp = models.IntegerField(default=0)
    id_suppression = models.IntegerField(default=0, blank=True)
    id_modification = models.IntegerField(default=0, blank=True)

    date_enregistrement = models.DateTimeField(auto_now_add=True)
    date_modification = models.DateTimeField(auto_now=True)
    date_suppression = models.DateTimeField(auto_now=False, auto_created=False, default='', blank=True)
    date_destruction = models.DateTimeField(auto_now=False, auto_created=False, default='', blank=True)

    def __str__(self):
        return "passage {0} n° {1} ".format(self.type_pied,  str(self.numero_passage))

    def save(self, *args, **kwargs):
        if self.id is None or len(str(self.id)) == 0:
            try:
                self.id = Passage.objects.latest('id').id + 1
            except Passage.DoesNotExist:
                self.id = 1

        if self.uuid is None:
            try:
                self.uuid = uuid.uuid4()
            except Exception as e:
                self.uuid = uuid.uuid4()

        if self.numero_passage == 0:
            print("passage date ", datetime.datetime.now().year)
            try:
                if self.type_pied.lower() in ["cacao", 'cacaos', "k"]:
                    self.numero_passage = Passage.objects.filter(Q(date_creation__year=datetime.datetime.now().year) & Q(type_pied="cacao")).filter(active=1).count() + 1
                elif self.type_pied.lower() in ["cafe", 'cafes', "c"]:
                    self.numero_passage = Passage.objects.filter(Q(date_creation__year=datetime.datetime.now().year) & Q(type_pied="cafe")).filter(active=1).count() + 1
            except Passage.DoesNotExist as e:
                self.numero_passage = 1
                print(e)
        super(Passage, self).save()


