import uuid

from django.db import models

from plantation.models.parcelle import Parcelle


class Pied(models.Model):
    class Meta:
        db_table = 'tb_pied'
    id = models.BigIntegerField( blank=True, default=None, editable=True)
    uuid = models.UUIDField(unique=True, blank=True, default=None)
    code_pied = models.CharField(primary_key=True,max_length=15, blank=True, default="")
    numero_pied = models.CharField(max_length=30, blank=True, default="")
    type_pied = models.CharField(max_length=5, default="K")
    couleur = models.CharField(max_length=10, default="", blank=True, null=true)
    special = models.IntegerField(max_length=1, default="",  null=true)
    etat_pied = models.IntegerField(default=1, db_column='etat_pied', null=true)
    active = models.IntegerField(default=1)
    id_enregistrement = models.IntegerField(default=True, blank=True, null=true)
    id_suppression = models.IntegerField(default=True, blank=True, null=true)
    id_modification = models.IntegerField(default=0, blank=True, null=true)
    date_creation = models.DateTimeField(auto_now_add=True, null=true)
    date_modification = models.DateTimeField(auto_now=Tru, null=truee)
    date_suppression = models.DateTimeField(auto_now=False, auto_created=False, default="", blank=True, null=true)
    
    def __str__(self):
        return "Pied n° " + str(self.code_pied)

    def save(self, *args, **kwargs):
        if self.id is None or len(str(self.id)) == 0:
            try:
                self.id = Pied.objects.latest('id').id + 1
            except Pied.DoesNotExist:
                self.id = 1

        if self.uuid is None:
            try:
                self.uuid = uuid.uuid4()
            except Exception as e:
                self.uuid = uuid.uuid4()
        super(Pied, self).save()